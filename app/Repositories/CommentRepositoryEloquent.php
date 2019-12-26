<?php

namespace App\Repositories;

use App\Model\Comment;
use App\Traits\Helper;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CommentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CommentRepositoryEloquent extends BaseRepository implements CommentRepository
{
    use Helper;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comment::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getTopComment()
    {
        return $this->scopeQuery(function ($query) {
            return $query
                ->with(['user', 'blog'])
                ->whereHas('blog', function ($q) {
                    $q->where('type', '=', Comment::BLOG);

                })
                ->where('type', Comment::BLOG)
                ->orderBy('created_at', 'DESC')
                ->orderBy('like', 'DESC')
                ->limit(config('constant.limit_comment'));
        })->all();
    }

    public function getCommentByBlog($blogId, $sortBy = Comment::LATEST)
    {
        return $this->scopeQuery(function ($query) use ($blogId, $sortBy) {
            $result = $query
                ->with(['reply.user', 'user'])
                ->where('parent_id', '=', 0)
                ->where([
                    'type' => Comment::BLOG,
                    'core_id' => $blogId
                ]);
            if ($sortBy == Comment::LATEST) {
                $result = $result->orderBy('created_at', 'DESC');
            }
            if ($sortBy == Comment::OLDEST) {
                $result = $result->orderBy('created_at', 'ASC');
            }
            return $result;
        })->paginate(config('constant.limit_comment'));
    }

    public function postCommentAjax($data = [])
    {
        $commentDB = $this->create([
            'type' => $data['type'],
            'core_id' => $data['core_id'],
            'content' => $this->contentImageEncodeBase64($data['content'])['doom'],
            'parent_id' => $data['parent_id'],
            'user_id' => Sentinel::getUser()->id
        ]);

        $comment = $this->scopeQuery(function ($query) use ($commentDB) {
            return $query
                ->with(['reply.user', 'user'])
                ->where('id', '=', $commentDB->id);
        })->first();

        if ($comment->parent_id === 0) {
            return view('sub.item_comment')->with(['comment' => $comment]);
        } else {
            return view('sub.item_reply')->with(['reply' => $comment]);
        }
    }

    public function editComment($id, $content, $oldContent)
    {
        $getDoom = $this->contentImageEncodeBase64($content);
        $content = $getDoom['doom'];
        $this->update(['content' => $content], $id);
        $this->deleteImageByContent($oldContent, $getDoom['arrSrcImg']);
        return $content;
    }

    public function getCommentById($id)
    {
        return $this->find($id);
    }

    public function deleteCommentById($id)
    {
        return $this->delete($id);
    }
}
