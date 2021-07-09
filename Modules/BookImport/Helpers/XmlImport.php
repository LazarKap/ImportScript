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
        $jsonXml = json_encode($newXml);
        // Convert into associative array
        $arrXml = json_decode($jsonXml, true);

        
        try {
            DB::table('books')->insert($arrXml);
            session()->flash('message', 'Podaci sacuvani');
        } catch (\Exception $e) {
            session()->flash('message', $e->getMessage());
        }

    }

}