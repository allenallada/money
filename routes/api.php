<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test2', function (Request $request) {
    return ['test' => 'test'];
});