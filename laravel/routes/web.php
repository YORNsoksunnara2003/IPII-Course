<?php
use App\Http\Controllers\UploadController;

Route::get('/upload', [UploadController::class, 'showForm'])->name('upload.form');
Route::post('/upload', [UploadController::class, 'uploadFile'])->name('upload.file');
