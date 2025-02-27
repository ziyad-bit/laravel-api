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
        try {

            $credentials = $request->only('email', 'password');
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->returnError('wrong password or email', 404);
            }

            return $this->returnSuccess('you successfully logged in', 'token', $token);

        } catch (JWTException $ex) {
            return $this->returnError("can't create token", $ex->getCode());
        }
    }

#######################################       logout        ##############################
    public function logout()
    {
        try {
            auth()->logout();

            return $this->returnSuccess('you successfully logged out');

        } catch (\Exception $ex) {
            return $this->returnError("something went wrong", 500);
        }
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
        try {
            $admin = Admins::create($request->validated());

            return new AdminResource($admin);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

#######################################       get all admins        ##############################
    public function get()
    {
        try {
            $admins = Admins::selection()->orderBy('id', 'desc')->paginate(5);

            return  AdminResource::collection($admins);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    #######################################       get count        ##############################
    public function getCount()
    {
        try {
            $adminsCount = Admins::all()->count();

            return $this->returnSuccess(null, 'admins_count', $adminsCount);

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }

    #######################################       update        ##############################
    public function update(AdminRequest $request, Admins $admin)
    {
        try {
            $admin->update($request->validated());

            return new AdminResource($admin);

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }

    #######################################       delete         ##############################
    public function delete(Admins $admin)
    {
        try {
            $admin->delete();

            return $this->returnSuccess('you successfully deleted admin');

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }
}
