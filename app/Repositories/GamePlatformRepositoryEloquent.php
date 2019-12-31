<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GamePlatformRepository;
use App\Model\GamePlatform;
use App\Validators\GamePlatformValidator;

/**
 * Class GamePlatformRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GamePlatformRepositoryEloquent extends BaseRepository implements GamePlatformRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GamePlatform::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
