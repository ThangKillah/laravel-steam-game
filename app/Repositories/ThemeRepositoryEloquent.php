<?php

namespace App\Repositories;

use App\Model\Theme;
use App\Validators\ThemeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ThemeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ThemeRepositoryEloquent extends BaseRepository implements ThemeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Theme::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
