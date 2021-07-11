<?php

namespace Modules\BookImport\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Book extends Model
{
    protected $fillable = ['naziv_knjige', 'autor', 'izdavac', 'godina_izdanja'];

    public function search($searchName, $searchYear){
         return Book::query()
        ->where('naziv_knjige', 'LIKE', "%{$searchName}%")
        ->orWhere('godina_izdanja', '=<', Carbon::now()->subYears($searchYear)->toDateTimeString())
        ->get();
    }

    public function getBooksByYear(){

    }
    
}
