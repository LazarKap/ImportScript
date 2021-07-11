@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Search for book</div>

                <div class="card-body">

                    <form method="get" action="{{route('search-book')}}">
                    @csrf
                        <div class="input-group m-3 w-50">
                            <input value="{{$search_name ?? ''}}" name="search_name" type="text" class="form-control" placeholder="Pretrazite prema nazivu"aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                                Search
                            </button>
                        </div>

                        <select class="form-select m-3 w-50" value="" name="search_year">
                            <option selected disabled>Godina Starosti</option>
                            <option value="5">Do 5 godina</option>
                            <option value="10">Do 10 godina</option>
                            <option value="older10">Preko 10 godina</option>
                        </select>  

                    </form>

                    @if($books)
                        @foreach ($books as $book)
                        <div class="list-group">    
                            <a href="{{route('show-book', ['id' => $book['id']])}}" class="list-group-item list-group-item-action">{{$book['naziv_knjige']}}</a>
                        </div>
                        @endforeach
                    @else 
                        <div>
                            <h2>No books found</h2>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
