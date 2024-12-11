<?php

use App\Livewire\FileManager;
use App\Livewire\PostManager;
use Illuminate\Support\Facades\Route;


Route::get('/', PostManager::class);
Route::get('/files', FileManager::class)->name('files.index');
