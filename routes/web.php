<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MediaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\VideosController;
use App\Http\Controllers\AudiosController;
use App\Http\Controllers\MediaDownloadController;

Route::post('/track-download', [MediaDownloadController::class, 'store'])->name('track.download');
Route::get('/', [HomeController::class, 'index']);
Route::get('/media', [MediaController::class, 'index']);
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/image-gallery', [ImagesController::class, 'index'])->name('image.gallery');
Route::get('/video-gallery', [VideosController::class, 'index']);
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/audio-gallery', [AudiosController::class, 'index'])->name('audio.gallery');

