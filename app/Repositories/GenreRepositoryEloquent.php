<?php

namespace App\Repositories;

use App\Model\Genre;
use App\Validators\GenreValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GenreRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GenreRepositoryEloquent extends BaseRepository implements GenreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Genre::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
