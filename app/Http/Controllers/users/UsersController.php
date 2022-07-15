<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;
use App\Traits\General;
use App\Traits\UploadPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    use UploadPhoto, General;

    public function __construct()
    {
        Auth::shouldUse('users');
    }

    ######################################        add            ##########################
    public function signup(UserRequest $request)
    {
        try {
            $user = Users::create($request->validated());

            return (new UserResource($user))->additional(['message'=>'you successfully register']);

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }

    ######################################        login            ##########################
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!$user_token = JWTAuth::attempt($credentials)) {
                return $this->returnError('wrong password or email', 404);
            }

            return $this->returnSuccess("you successfully logged in",'user_token',$user_token);

        } catch (JWTException $e) {
            return $this->returnError("something went wrong", 500);
        }
    }

    ######################################        get auth user            ##########################
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return $this->returnError("user not found", 404);
            }

            return new UserResource($user);

        } catch (TokenExpiredException $e) {
            return $this->returnError("token is expired", $e->getStatusCode());

        } catch (TokenInvalidException $e) {
            return $this->returnError("token is invalid", $e->getStatusCode());

        } catch (JWTException $e) {
            return $this->returnError("token is absent", $e->getStatusCode());
        }
    }

    #######################################       logout        ##############################
    public function logout(Request $request)
    {
        try {
            $token = $request->header('userToken');
            JWTAuth::setToken($token)->invalidate();

            return $this->returnSuccess('you successfully logout');

        } catch (\Exception $ex) {
            return $this->returnError("something went wrong", 500);
        }
    }
}
