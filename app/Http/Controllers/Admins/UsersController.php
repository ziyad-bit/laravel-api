<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\Users;
use App\Traits\General;
use App\Traits\UploadPhoto;

class UsersController extends Controller
{
    use UploadPhoto, General;

    ######################################        get            ############################
    public function get()
    {
        try {
            $users = Users::selection()->orderBy('id', 'desc')->paginate(5);

            return  UserResource::collection($users);
        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }

    ######################################        add            #################################
    public function add(UserRequest $request)
    {
        try {
            $path = null;
            if ($request->has('photo')) {
                $path = $this->uploadPhoto($request, 300);
            }

            $user = Users::create($request->except('photo') + ['photo' => $path]);

            return new UserResource($user);

        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }

    ######################################        edit            ##########################
    public function edit(Users $user)
    {
        try {
            return new UserResource($user);

        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }

    ######################################        update            ##########################
    public function update(UserRequest $request, Users $user)
    {
        try {
            $path = $user->photo;
            if ($request->has('photo')) {
                $path = $this->uploadPhoto($request, 300);
            }

            $user->update($request->except('photo') + ['photo' => $path]);

            return new UserResource($user);

        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }

    ######################################        get count            ##########################
    public function getCount()
    {
        try {
            $users_count = Users::all()->count();
            
            return response()->json(compact('users_count'));

        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }

    ######################################        delete            ##########################
    public function delete(Users $user)
    {
        try {
            $user->delete();

            return response()->json(['message'=>'you successfully deleted user']);

        } catch (\Exception $th) {
            return response()->json(['message'=>'something went wrong'],500);
        }
    }
}
