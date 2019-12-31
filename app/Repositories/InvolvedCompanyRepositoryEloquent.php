<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InvolvedCompanyRepository;
use App\Model\InvolvedCompany;
use App\Validators\InvolvedCompanyValidator;

/**
 * Class InvolvedCompanyRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InvolvedCompanyRepositoryEloquent extends BaseRepository implements InvolvedCompanyRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return InvolvedCompany::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
