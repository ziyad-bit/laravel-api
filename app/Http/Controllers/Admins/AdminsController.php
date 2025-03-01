<?php

namespace App\Http\Controllers\Admins;

use App\Models\Admins;
use App\Traits\General;
use App\Traits\UploadPhoto;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Requests\AdminRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\AdminResource;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminsController extends Controller
{
    use UploadPhoto;
    use General;

    #######################################       login        ##############################
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = auth()->attempt($credentials)) {
            return $this->returnError('wrong password or email', 404);
        }

        return $this->returnSuccess('you successfully logged in', 'token', $token);
    }

    #######################################       logout        ##############################
    public function logout()
    {
        auth()->logout();

        return $this->returnSuccess('you successfully logged out');
    }

    #######################################       get authenticated admin     ##############################
    public function getAuthenticated()
    {
        $admin = auth()->user();

        return new AdminResource($admin);
    }

    #######################################       add         ##############################
    public function add(AdminRequest $request)
    {
        $admin = Admins::create($request->validated());

        return new AdminResource($admin);
    }

    #######################################       get all admins        ##############################
    public function get()
    {
        $admins = Admins::selection()->orderBy('id', 'desc')->paginate(5);

        return  AdminResource::collection($admins);
    }

    #######################################       get count        ##############################
    public function getCount()
    {
        $adminsCount = Admins::all()->count();

        return $this->returnSuccess(null, 'admins_count', $adminsCount);
    }

    #######################################       update        ##############################
    public function update(AdminRequest $request, Admins $admin)
    {
        $admin->update($request->validated());

        return new AdminResource($admin);
    }

    #######################################       delete         ##############################
    public function delete(Admins $admin)
    {
        $admin->delete();

        return $this->returnSuccess('you successfully deleted admin');
    }
}
