<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\DB;


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

        $arrayTest = array_column(array_column($arrXml['Record'], 'Row'), '@attributes');
        $headers = array_shift($arrayTest);

        $data = [];

        foreach($arrayTest as $row){
            $data[] = array_combine($headers, $row);
        }


        
        try {
            DB::table('books')->insert($data);
            session()->flash('message', 'Podaci sacuvani');
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
        }

    }

}