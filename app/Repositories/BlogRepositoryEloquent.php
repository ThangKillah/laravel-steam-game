<?php

namespace App\Repositories;

use App\Model\Blog;
use App\Model\Comment;
use Illuminate\Database\Eloquent\Builder;
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
        return $this->scopeQuery(function ($query) use ($condition) {
            $result = $query->with([
                'category.association'
            ]);

            if (!empty($condition['title'])) {
                $title = $condition['title'];
                $result = $result->where('title', 'like', '%' . $title . '%');
            }
            if (!empty($condition['platform'])) {
                $result = $result->whereHas('category', function ($q) use ($condition) {
                    $q->where('association_id', $condition['platform']);
                });
            }
            if (!empty($condition['sortBy'])) {
                $sort = $condition['sortBy'];
                if ($sort == Blog::BEST) {
                    $result = $result->orderBy('count_view', 'DESC')->orderBy('publish_date', 'DESC');;
                }
                if ($sort == Blog::NEWEST) {
                    $result = $result->orderBy('publish_date', 'DESC');
                }
                if ($sort == Blog::OLDEST) {
                    $result = $result->orderBy('publish_date', 'ASC');
                }
            }
            return $result;
        })->paginate(config('constant.paginate_blog'));
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
                ->withCount(['comments' => function (Builder $query) {
                    $query->where('type', Comment::BLOG);
                }])
                ->where([
                    'slug' => $slug,
                    'id' => $idDecode
                ]);
        })->first();
    }

    public function getRelatedBlog($category)
    {
        $blogId = 0;
        $associationIds = [];
        if (!empty($category)) {
            foreach ($category as $cate) {
                $blogId = $cate->blog_id;
                if ($cate->association->type == 'games') {
                    $associationIds[] = $cate->association->id;
                }
            }
        }

        if (empty($associationIds)) {
            return [];
        }

        return $this->scopeQuery(function ($query) use ($associationIds, $blogId) {
            return $query
                ->where('id', '!=', $blogId)
                ->whereHas('category', function (Builder $queryBuilder) use ($associationIds) {
                    $queryBuilder->whereIn('association_id', $associationIds);
                })
                ->orderBy('count_view', 'DESC')
                ->orderBy('publish_date', 'DESC')
                ->limit(config('constant.limit_related_blog'));
        })->all();
    }
}
