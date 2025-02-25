<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

trait UploadPhoto
{
    public function uploadPhoto($request, $width = null, $height = null)
    {
        $file = $request->file('photo');
        $path = $file->hashName('images');

        $img = Image::make($file)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        })->encode();

        Storage::put( $path, $img);
        return $path;
    }
}
