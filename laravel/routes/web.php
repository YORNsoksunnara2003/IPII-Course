<?php
use App\Http\Controllers\UploadController;

Route::get('/upload_file', function(){
    return view('upload_file');
});
Route::post('/upload', [UploadController::class, 'upload'])->name('upload');
