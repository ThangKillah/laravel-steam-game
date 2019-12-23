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

        Sentinel::login($user);


        return $user;
    }

    public function dsq_hmacsha1($data, $key)
    {
        $blocksize = 64;
        $hashfunc = 'sha1';
        if (strlen($key) > $blocksize)
            $key = pack('H*', $hashfunc($key));
        $key = str_pad($key, $blocksize, chr(0x00));
        $ipad = str_repeat(chr(0x36), $blocksize);
        $opad = str_repeat(chr(0x5c), $blocksize);
        $hmac = pack(
            'H*', $hashfunc(
                ($key ^ $opad) . pack(
                    'H*', $hashfunc(
                        ($key ^ $ipad) . $data
                    )
                )
            )
        );
        return bin2hex($hmac);
    }

    public function loginDisqus(int $userId)
    {
        //        $user = $this->find($userId);

        //        $data = array(
        //            "id" => $user->id,
        //            "username" => $user->name,
        //            "email" => $user->email
        //        );

        $data = array(
            "id" => 1334123,
            "username" => 'thangbt1307',
            "email" => 'buithang1307@gmail.com'
        );

        $message = base64_encode(json_encode($data));
        $timestamp = time();
        $hmac = $this->dsq_hmacsha1($message . ' ' . $timestamp, config('services.disqus.secret_key'));

        $authToken = $message . ' ' . $hmac . ' ' . $timestamp;
        return $authToken;
    }
}
