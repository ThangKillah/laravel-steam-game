<?php

namespace App\Repositories;

use App\Model\Mode;
use App\Validators\ModeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ModeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ModeRepositoryEloquent extends BaseRepository implements ModeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Mode::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
