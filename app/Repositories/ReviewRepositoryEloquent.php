<?php

namespace App\Repositories;

use App\Model\Review;
use App\Validators\ReviewValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ReviewRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ReviewRepositoryEloquent extends BaseRepository implements ReviewRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Review::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getTopReview(int $number)
    {
        return $this->scopeQuery(function ($query) use ($number) {
            return $query::orderBy('publish_date', 'DESC')
                ->with(['game'])
                ->limit($number);
        })->all();
    }
}
