<?php

namespace App\Repositories;

use App\Model\Blog;
use App\Validators\BlogValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Vinkla\Hashids\Facades\Hashids;

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

    public function getBlogDetail($slug, $id)
    {
        try {
            $idDecode = Hashids::decode($id)[0];
        } catch (\Exception $exception) {
            return [];
        }

        return $this->scopeQuery(function ($query) use ($slug, $idDecode) {
            return $query
                ->with([
                    'category.association'
                ])
                ->where([
                    'slug' => $slug,
                    'id' => $idDecode
                ]);
        })->first();
    }
}
