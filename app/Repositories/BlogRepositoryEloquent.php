<?php

namespace App\Repositories;

use App\Model\Blog;
use App\Validators\BlogValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BlogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BlogRepositoryEloquent extends BaseRepository implements BlogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Blog::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getBlogSearch($condition = [])
    {
        return $this->scopeQuery(function ($query) {
            return $query->with([
                'category.association'
            ])
                ->orderBy('count_view', 'DESC')
                ->orderBy('publish_date', 'DESC');
        })->paginate(5);
    }

    public function getTopBlog()
    {
        return $this->scopeQuery(function ($query) {
            return $query->with([
                'category.association'
            ])
                ->orderBy('count_view', 'DESC')
                ->orderBy('publish_date', 'DESC')
                ->limit(config('constant.limit_top_blog'));
        })->all();
    }
}
