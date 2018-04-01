<?php
/**
 * Created by PhpStorm.
 * User: KIBB
 * Date: 4/1/2018
 * Time: 12:34 AM
 */
namespace App;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth as BaseJWTAuth;
use Tymon\JWTAuth\JWTManager;
use Tymon\JWTAuth\Providers\Auth\AuthInterface;
use Tymon\JWTAuth\Providers\User\UserInterface;

class JWTAuth  extends BaseJWTAuth{
    public function __construct(JWTManager $manager, UserInterface $user, AuthInterface $auth, Request $request)
    {
        parent::__construct($manager, $user, $auth, $request);
    }

    public function parseToken($method = 'bearer', $header = 'authorization', $query = 'token')
    {
        return parent::parseToken($method, $header, $query);
    }
}