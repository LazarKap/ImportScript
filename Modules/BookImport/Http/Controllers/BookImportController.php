<?php

namespace Modules\BookImport\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BookImport\Models\Book as BookModel;
use Exception;
use Illuminate\Support\Facades\Auth;
use Modules\BookImport\Http\Requests\BookImportRequest;



class BookImportController extends Controller
{

    public function __construct(BookModel $book)
    {
        $this->book = $book;
    }
    
    public function importView(){
        
        return view('bookimport::bookimport');

    }

    public function bookImport(BookImportRequest $request){

        try {

            $importFile = $request->file('import_file');
            $importType = $importFile->getClientOriginalExtension();

        
            $this->importer($importType)->import($importFile);

        } catch (Exception $e) {

            session()->flash('Greska prilikom importovanja fajla', $e->getMessage());
            return redirect()->route('import_view');

        }

        return redirect()->route('import_view');
    }

    private function importer($importType){

        $helperNamespace = "\\Modules\\BookImport\\Helpers\\";

        $importer = ($helperNamespace) . ucfirst($importType) . "Import";
        if (!class_exists($importer)) {
            throw new Exception('Ekstenzija'. ($importType) .'nije podrzana');
        }
        return new $importer;

    }

}
