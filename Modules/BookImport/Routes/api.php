<?php

use Illuminate\Support\Facades\Route;
use Modules\BookImport\Http\Controllers\BookApiController;



Route::prefix('/api')->group(function () {
    
    Route::get('/books', [BookApiController::class, 'list']);
    Route::get('/books/book/{id}', [BookApiController::class, 'show']);

});