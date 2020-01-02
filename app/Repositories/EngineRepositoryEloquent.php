<?php

namespace App\Repositories;

use App\Model\Engine;
use App\Validators\EngineValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class EngineRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EngineRepositoryEloquent extends BaseRepository implements EngineRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Engine::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
