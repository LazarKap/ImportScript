<?php

namespace Modules\BookImport\Helpers;

use Modules\BookImport\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Date;

class AbstractImporter implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        try {

            return new Book([
                'naziv_knjige'      => $row['naziv_knjige'],
                'autor'             => str_replace(",", " ", $row['autor']),
                'izdavac'           => $row['izdavac'],
                'godina_izdanja'    => Date::createFromFormat("d/m/Y", $row['godina_izdanja'])->format('Y-m-d'),
            ]);
            session()->flash('message', 'Podaci sacuvani');
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
        }
        
    }

    public function dateConverter(){

    }

    public function columnNameTransform(){

    }

    public function authorNameTransfcorm(){

    


}