<?php

namespace App\Repositories;

use App\Model\Comment;
use App\Validators\CommentValidator;
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
        })->paginate(1);
    }

}
