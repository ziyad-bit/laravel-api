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
    use UploadPhoto;
    use General;

    ########################################       get      #############################
    public function get()
    {
        $categories = Category::selection()->paginate(5);

        return  CategoryResource::collection($categories);
    }

    ########################################       add      #############################
    public function add(CategoryRequest $request)
    {
        //import from trait(UploadPhoto)
        $path = $this->uploadPhoto($request, 300);

        $category = Category::create($request->except('photo') + ['photo' => $path]);

        return new CategoryResource($category);
    }

    ########################################       update      #############################
    public function update(CategoryRequest $request, Category $category)
    {
        $path = $category->photo;
        if ($request->has('photo')) {
            $path = $this->uploadPhoto($request, 300);
        }

        $category->update($request->except('photo') + ['photo' => $path]);

        return new CategoryResource($category);
    }

    ########################################       delete      #############################
    public function delete(Category $category)
    {
        $category->delete();

        return $this->returnSuccess('you successfully deleted category');
    }
}
