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

        $searchName = $request->input('search_name');
        $searchYear = $request->input('search_year');
    
        $books      = $this->book->search($searchName, $searchYear)->get();

        return view('bookimport::booksearch')
        ->with([
            'books'         => $books,
            'search_name'   => $searchName,
            'search_year'   => $searchYear
        ]);
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
