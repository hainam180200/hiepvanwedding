<?php

require __DIR__.'/api.php';
require __DIR__.'/backend_route.php';
require __DIR__.'/frontend_route.php';
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
