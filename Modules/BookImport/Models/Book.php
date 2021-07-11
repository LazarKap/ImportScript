<?php

namespace Modules\BookImport\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = ['naziv_knjige', 'autor', 'izdavac', 'godina_izdanja'];
    
    /**
     * search funkcija u modelu koja sluzi za pretrazivanje baze na osvnovu Imena ili Godine
     *
     * @param  mixed $searchName
     * @param  mixed $searchYear
     * @return void
     */
    public function search($searchName, $searchYear){

         $book =  Book::query();

        if($searchYear == 'older10'){
            $book->whereDate('godina_izdanja', '<', now()->subYears(10));
        }
        elseif ($searchYear) {
            $book->whereDate('godina_izdanja', '>', now()->subYears($searchYear));
        }
        if ($searchName) {
            $book->where('naziv_knjige', 'LIKE', "%{$searchName}%");
        }

        return $book;
    }
    
}
