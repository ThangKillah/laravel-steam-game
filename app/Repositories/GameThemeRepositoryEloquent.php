<?php

namespace App\Repositories;

use App\Model\GameTheme;
use App\Validators\GameThemeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class GameThemeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class GameThemeRepositoryEloquent extends BaseRepository implements GameThemeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return GameTheme::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
