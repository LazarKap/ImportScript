<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;



class XmlImport {

    public function import($importfile)
    {
        // Read entire file into string
        $xmlfile = file_get_contents($importfile);
        // Convert xml string into an object
        $newXml = simplexml_load_string($xmlfile);
        // Convert into json
        $jsonXml = json_encode((array)$newXml);
        // Convert into associative array
        $arrXml = json_decode($jsonXml, true);

        $data = $arrXml['row'];

        foreach ($data as $row) {



                $date       = Date::createFromFormat("d/m/Y", $row['Godina_Izdanja'])->format('Y-m-d');
                $author     = str_replace(",", " ", $row['Autor']);

                $row['godina_izdanja'] = $date;
                $row['autor'] = $author;

                $dataFin[] = $dataNew; 

        }

        try {
            DB::table('books')->insert($data);
            session()->flash('message', 'Podaci sacuvani');
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
        }

    }

}