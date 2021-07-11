<?php

namespace Modules\BookImport\Helpers;

use Illuminate\Http\Request;
use Modules\BookImport\Helpers\ImportBookModel;
use Maatwebsite\Excel\Facades\Excel;

class XlsImport {

    public function import($importFile){

        Excel::import(new ImportBookModel, $importFile);
        
    }

}

