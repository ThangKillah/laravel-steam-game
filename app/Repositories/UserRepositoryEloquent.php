<?php

namespace App\Repositories;

use App\Model\User;
use App\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Sentinel;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function register($params = [])
    {
        $credentials = [
            'email' => $params['email'],
            'name' => $params['name'],
            'password' => $params['password'],
        ];

        $user = Sentinel::registerAndActivate($credentials);

        return $user;
    }

}
