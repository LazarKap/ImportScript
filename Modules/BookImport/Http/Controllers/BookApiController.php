<?php

namespace Modules\BookImport\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BookImport\Models\Book as BookModel;

class BookApiController extends Controller
{
    
    public function __construct(BookModel $book)
    {
        $this->book = $book;
    }


    public function list(){

        $books = $this->book->all()->toArray();

        if ($books) {
            $response = [
                'status'    => 'success',
                'message'   => 'Books were successfully fetched',
                'books'     => $books
            ];
        } else {
            $response = [
                'status'    => 'error',
                'message'   => 'An error ocured while fetching books'
            ];
        }
        return response()->json($response);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $book = $this->book->where('id', $id)->first();

        if ($book) {
            $response = [
                'status'    => 'success',
                'message'   => 'Book was successfully fetched',
                'book'      => $book
            ];
        } else {
            $response = [
                'status'    => 'error',
                'message'   => 'An error ocured while fetching a book'
            ];
        }
        return response()->json($response);
    }
}
