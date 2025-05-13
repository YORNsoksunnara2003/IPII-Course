<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Http\Controllers\UploadController;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048' // Validation rules for upload
        ]);
            $image = $request->file('document');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('uploads', $fileName); 
            
            $thumbnailPath = 'thumbnails/' . $fileName;
            $intervention = Image::make($image->getRealPath());
            $intervention->fit(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/public/' . $thumbnailPath));

            Storage::put($thumbnailPath, $intervention->stream());

            return $path;
            
    }
}
