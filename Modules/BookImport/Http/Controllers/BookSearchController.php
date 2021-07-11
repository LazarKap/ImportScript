<?php

namespace Modules\BookImport\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BookImport\Models\Book as BookModel;
use Exception;
use Carbon\Carbon;

class BookSearchController extends Controller
{
    public function __construct(BookModel $book)
    {
        $this->book = $book;
    }

    public function searchView(){

        $books = $this->book->all()->toArray();

        return view('bookimport::booksearch')->with('books', $books);
    }

    public function search(Request $request){

        $searchName = $request->input('search');
        $searchYear = $request->input('search_year');
    
        $books = $this->book->search($searchName, $searchYear);

        return view('bookimport::booksearch')->with('books', $books);
    }

    public function showBook($id){
        
        try {

            $book = $this->book->where('id', $id)->first();

        } catch (Exception $e) {

            session()->flash('Greska prilikom otvaranja knjige', $e->getMessage());
            return redirect()->route('search-book');

        }

        return view('bookimport::book')->with('book', $book);

    }
}
