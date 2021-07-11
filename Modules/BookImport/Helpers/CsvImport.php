<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\DB;

use Modules\BookImport\Helpers\AbstractImport;

class CsvImport extends AbstractImport
{    
    /**
     * import funkcija koja sluzi za importovanje knjiga u bazu podataka
     *
     * @param  mixed $importfile
     * @return void
     */
    public function import($importfile)
    {
        $file = file($importfile);
        $firstRow = true;

        foreach ($file as $row) {

            if ($firstRow) {

                $firstRow   = false;
                $columns    = str_getcsv($row);
                $columnsNew = $this->columnNameTransform($columns);

            } else if (!empty($columnsNew)) {

                $dataNew = array_combine($columnsNew, str_getcsv($row));

                $dataNew['godina_izdanja']      = $this->dateConverter($dataNew);
                $dataNew['autor']               = $this->authorTransform($dataNew);

                $data[] = $dataNew; 

            } else {

                session()->flash('message', 'Problem u cuvanju podataka.');

            }

        }
        try {

            DB::table('books')->insert($data);
            session()->flash('message', 'Podaci sacuvani');

        } catch (\Exception $e) {

            session()->flash('message', $e->getMessage());

        }
    }

}