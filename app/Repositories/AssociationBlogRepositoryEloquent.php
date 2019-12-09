<?php

namespace App\Repositories;

use App\Model\AssociationBlog;
use App\Validators\AssociationBlogValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class AssociationBlogRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AssociationBlogRepositoryEloquent extends BaseRepository implements AssociationBlogRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AssociationBlog::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
