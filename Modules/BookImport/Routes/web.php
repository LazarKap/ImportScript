<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Modules\BookImport\Http\Controllers\BookImportController;
use Modules\BookImport\Http\Controllers\BookSearchController;

Route::group(['middleware'=>['web', 'auth']], function(){

    Route::get('/importbook', [BookImportController::class, 'importView'])->name('import_view');
    Route::post('/importbook', [BookImportController::class, 'bookImport'])->name('import_file');
    Route::get('/search', [BookSearchController::class, 'searchView'])->name('search');
    Route::get('/search/book', [BookSearchController::class, 'search'])->name('search-book');
    Route::get('/search/book/{id}', [BookSearchController::class, 'showBook'])->name('show-book');

});
