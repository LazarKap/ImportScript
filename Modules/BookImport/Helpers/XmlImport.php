<?php

namespace Modules\BookImport\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Date;
use Modules\BookImport\Helpers\AbstractImport;




class XmlImport extends AbstractImport {
    
    /**
     * import funkcija koja sluzi za import knjiga u bazu podataka
     *
     * @param  mixed $importfile
     * @return void
     */
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

        $dataNew = [];

        foreach($arrXml['row'] as $key => $row){

            
            $date   = $this->dateConverter($row);
            $author = $this->authorTransform($row);

            $dataNew[] = $row;

            $dataNew[$key]['godina_izdanja'] = $date;
            $dataNew[$key]['autor'] = $author;
        }

        try {

            DB::table('books')->insert($dataNew);
            session()->flash('message', 'Podaci sacuvani');

        } catch (\Exception $e) {

            session()->flash('message', $e->getMessage());
        }

    }

}