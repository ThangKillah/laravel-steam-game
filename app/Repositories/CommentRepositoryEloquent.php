<?php

namespace App\Repositories;

use App\Model\Comment;
use App\Validators\CommentValidator;
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

    public function getCommentByBlog($blogId)
    {
        return $this->scopeQuery(function ($query) use ($blogId) {
            return $query
                ->with(['reply.user', 'user'])
                ->where('parent_id', '=', 0)
                ->where([
                    'type' => Comment::BLOG,
                    'core_id' => $blogId
                ]);
        })->paginate(10);
    }

    public function postCommentAjax($data = [])
    {
        $commentDB = $this->create([
            'type' => $data['type'],
            'core_id' => $data['core_id'],
            'content' => $data['content'],
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
}
