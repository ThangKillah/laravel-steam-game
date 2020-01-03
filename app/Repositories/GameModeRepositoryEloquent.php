<?php

namespace App\Repositories;

use App\Model\GameMode;
use App\Validators\GameModeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GameModeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GameModeRepositoryEloquent extends BaseRepository implements GameModeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GameMode::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
