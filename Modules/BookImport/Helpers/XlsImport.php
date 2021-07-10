<?php

namespace Modules\BookImport\Helpers;

use Illuminate\Http\Request;
use Modules\BookImport\Helpers\AbstractImporter;
use Maatwebsite\Excel\Facades\Excel;

class XlsImport {

    public function import($importFile){

        Excel::import(new AbstractImporter, $importFile);
        
    }

}

