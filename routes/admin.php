<?php
use App\Http\Controllers\Admin\ChannelController;

Route::get('/', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::resource('/channels', ChannelController::class);