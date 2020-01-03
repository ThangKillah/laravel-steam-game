<?php

namespace App\Repositories;

use App\Model\GameGenre;
use App\Validators\GameGenreValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GameGenreRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GameGenreRepositoryEloquent extends BaseRepository implements GameGenreRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GameGenre::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
