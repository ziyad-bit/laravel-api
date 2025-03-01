<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Users;
use App\Traits\General;
use App\Traits\UploadPhoto;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class UsersController extends Controller
{
    use UploadPhoto;
    use General;

    ######################################        add            ##########################
    public function signup(UserRequest $request)
    {
        $user = Users::create($request->validated());

        return new UserResource($user);
    }

    ######################################        login            ##########################
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$user_token = auth('users')->attempt($credentials)) {
            return $this->returnError('wrong password or email', 404);
        }

        return $this->returnSuccess("you successfully logged in", 'user_token', $user_token);
    }

    ######################################        get auth user            ##########################
    public function getAuthenticatedUser()
    {
        $user = auth()->user();

        return new UserResource($user);
    }

    #######################################       logout        ##############################
    public function logout()
    {
        auth()->logout();

        return $this->returnSuccess('you successfully logout');
    }
}
