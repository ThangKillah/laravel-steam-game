<?php

namespace App\Repositories;

use App\Model\GameEngine;
use App\Validators\GameEngineValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GameEngineRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GameEngineRepositoryEloquent extends BaseRepository implements GameEngineRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GameEngine::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
