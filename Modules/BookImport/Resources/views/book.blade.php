@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">

                <ul class="list-group">
                <li class="list-group-item active">Naziv knjige: {{$book->naziv_knjige}}</li>
                <li class="list-group-item">Autor: {{$book->autor}}</li>
                <li class="list-group-item">Izdavac: {{$book->izdavac}}</li>
                <li class="list-group-item">Godina Izdanja: {{$book->godina_izdanja}}</li>
                <li class="list-group-item">Vestibulum at eros</li>

                </ul>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
