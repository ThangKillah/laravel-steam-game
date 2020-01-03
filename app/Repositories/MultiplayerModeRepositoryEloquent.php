<?php

namespace App\Repositories;

use App\Model\MultiplayerMode;
use App\Validators\MultiplayerModeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class MultiplayerModeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class MultiplayerModeRepositoryEloquent extends BaseRepository implements MultiplayerModeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return MultiplayerMode::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
