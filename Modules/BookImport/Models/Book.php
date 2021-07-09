<?php

namespace Modules\BookImport\Models;

use Illuminate\Database\Eloquent\Model;


class Book extends Model
{
    protected $fillable = ['naziv_knjige', 'autor', 'izdavac', 'godina_izdanja'];
    
    public function importBookData(){

    }
    
}
