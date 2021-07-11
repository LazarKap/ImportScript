<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Modules\BookImport\Helpers\AbstractImporter;

class CsvImport 
{
    public function import($importfile)
    {
        $file = file($importfile);
        $firstRow = true;

        foreach ($file as $row) {
            if ($firstRow) {

                $firstRow = false;
                $columns = str_getcsv($row);
                foreach ($columns as $column) {
                $columnsNew[] = str_replace(" ", "_", strtolower($column));
                }
                
            } else if (!empty($columnsNew)) {

                $dataNew    =  array_combine($columnsNew, str_getcsv($row));

                $date       = Date::createFromFormat("d/m/Y", $dataNew['godina_izdanja'])->format('Y-m-d');
                $author     = $dataNew['autor'];
                
                $dataNew['godina_izdanja'] = $date;
                $dataNew['autor'] = str_replace(",", " ", $author);

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