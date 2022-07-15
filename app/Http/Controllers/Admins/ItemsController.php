<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Items;
use App\Traits\General;
use App\Traits\UploadPhoto;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    use UploadPhoto;
    use General;

    ######################################        get            ##########################
    public function get()
    {
        try {
            $items = Items::selection()
                ->with(['admin'=>fn($q)=>$q->selection()
                        ,'category'=>fn($q)=>$q->selection()])
                ->orderBy('id', 'desc')->paginate(5);

            return  ItemResource::collection($items);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ######################################        add            ##########################
    public function add(ItemRequest $request)
    {
        try {
            $path = $this->uploadPhoto($request, 300);

            $item = Items::create($request->except('photo') + ['photo' => $path ,'admin_id'=>Auth::id()]);

            return new ItemResource($item);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ######################################        edit            ##########################
    public function edit(Items $item)
    {
        try {
            return new ItemResource($item);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ######################################        update           ##########################
    public function update(ItemRequest $request,Items $item)
    {
        try {
            $path = $item->photo;
            if ($request->has('photo')) {
                $path = $this->uploadPhoto($request, 300);
            }

            $item->update($request->except('photo') + ['photo' => $path]);

            return new ItemResource($item);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ######################################        get count            ##########################
    public function getCount()
    {
        try {
            $itemsCount = Items::all()->count();

            return $this->returnSuccess(null,'itemsCount',$itemsCount);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ######################################        delete            ##########################
    public function delete(Items $item)
    {
        try {
            $item->delete();

            return $this->returnSuccess('you successfully deleted item');

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }
}
