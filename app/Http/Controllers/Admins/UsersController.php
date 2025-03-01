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
    use UploadPhoto;
    use General;

    ######################################        get            ############################
    public function get()
    {
        $users = Users::selection()->orderBy('id', 'desc')->paginate(5);

        return  UserResource::collection($users);
    }

    ######################################        add            #################################
    public function add(UserRequest $request)
    {
        $path = null;
        if ($request->has('photo')) {
            $path = $this->uploadPhoto($request, 300);
        }

        $user = Users::create($request->except('photo') + ['photo' => $path]);

        return new UserResource($user);
    }

    ######################################        edit            ##########################
    public function edit(Users $user)
    {
        return new UserResource($user);
    }

    ######################################        update            ##########################
    public function update(UserRequest $request, Users $user)
    {
        $path = $user->photo;
        if ($request->has('photo')) {
            $path = $this->uploadPhoto($request, 300);
        }

        $user->update($request->except('photo') + ['photo' => $path]);

        return new UserResource($user);
    }

    ######################################        get count            ##########################
    public function getCount()
    {
        $users_count = Users::all()->count();

        return response()->json(compact('users_count'));
    }

    ######################################        delete            ##########################
    public function delete(Users $user)
    {
        $user->delete();

        return response()->json(['message' => 'you successfully deleted user']);
    }
}
