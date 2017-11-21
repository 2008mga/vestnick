<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class UploaderController extends Controller
{
    protected function __upload($type, $file)
    {
        $data = [];

        if (is_array($file)) {

            foreach ($file as $item) {
                $data[] = $this->__upload($type, $item);
            }

            return $data;
        }

        $image = Image::make($file);

        $filename = hash('sha256', $image->encode('data-url') . \Hash::make('laravel')) .'.png';
        $publicPath = '/images/upload/' . $filename;
        $path = public_path('/images/upload/' . $filename);

        $image->save($path);

        return asset($publicPath);

    }

    public function image(Request $request)
    {
        return response()->json([
            'url' => $this->__upload('image', $request->file('image'))
        ]);
    }
}
