<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\Date;

abstract class AbstractImport
{
    /**
     * dateConverter funkcija koza sluzi za konvertovanje datuma iz Y/M/D u D/M/Y
     *
     * @param  mixed $values
     * @return array
     */
    protected function dateConverter($data)
    {
        return $data['godina_izdanja'] = Date::createFromFormat("d/m/Y", $data['godina_izdanja'])->format('Y-m-d');;
    }   

    /**
     * columnNameTransform funkcija koja sluzi za transformisanje velikih slova u mala i razmaka u "_" kod Coulm name-a
     *
     * @param  mixed $headerColumns
     * @return array
     */
    protected function columnNameTransform($columns)
    {
        $columnNew = [];

        foreach ($columns as $column) {
            $columnNew[] = str_replace(" ", "_", strtolower($column));
        }

        return $columnNew;
    }
    
    /**
     * authorTransform funkcija koja sluzi za brisanje zareza kod imena autora
     *
     * @param  mixed $data
     * @return void
     */
    public function authorTransform($data){
        $author     = $data['autor'];
        $authors    = str_replace(",", " ", $author);
        return $authors;
    }

}
