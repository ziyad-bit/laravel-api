<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\General;
use App\Traits\UploadPhoto;

class CategoryController extends Controller
{
    use UploadPhoto, General;

    ########################################       get      #############################
    public function get()
    {
        try {
            $categories = Category::selection()->paginate(5);

            return  CategoryResource::collection($categories);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ########################################       add      #############################
    public function add(CategoryRequest $request)
    {
        try {
            //import from trait(UploadPhoto)
            $path = $this->uploadPhoto($request, 300);

            $category = Category::create($request->except('photo') + ['photo' => $path]);

            return new CategoryResource($category);

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }

    ########################################       edit     #############################
    public function edit(Category $category)
    {
        try {
            return new CategoryResource($category);

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }

    ########################################       update      #############################
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $path = $category->photo;
            if ($request->has('photo')) {
                $path = $this->uploadPhoto($request, 300);
            }

            $category->update($request->except('photo') + ['photo' => $path]);

            return new CategoryResource($category);

        } catch (\Exception $th) {
            return $this->returnError("something went wrong", 500);
        }
    }

    ########################################       delete      #############################
    public function delete(Category $category)
    {
        try {
            $category->delete();

            return $this->returnSuccess('you successfully deleted category');

        } catch (\Exception $th) {
            return $this->returnError('something went wrong', 500);
        }
    }
}
