<?php

namespace Modules\BookImport\Helpers;

use Modules\BookImport\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\BookImport\Helpers\AbstractImport;


class ImportBookModel extends AbstractImport implements ToModel, WithHeadingRow
{
        
    /**
     * model funkija koja sluzi za upisivanje xls fajla u tabelu books
     *
     * @param  mixed $row
     * @return void
     */
    public function model(array $row)
    {
        try {
            
            return new Book([
                'naziv_knjige'      => $row['naziv_knjige'],
                'autor'             => $this->authorTransform($row),
                'izdavac'           => $row['izdavac'],
                'godina_izdanja'    => $this->dateConverter($row),
            ]);

            session()->flash('message', 'Podaci sacuvani');

        } catch (\Exception $e) {

            session()->flash('message', $e->getMessage());
        }
        
    }
}