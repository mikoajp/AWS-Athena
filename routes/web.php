<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\S3Controller;
Route::get('/', function () {
    return view('livewire.data-table');
});


Route::get('/upload', [S3Controller::class, 'showForm']);
Route::post('/upload', [S3Controller::class, 'uploadFile'])->name('upload');
