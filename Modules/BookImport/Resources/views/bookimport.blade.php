
@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-center">

    <form method='post' action="{{route('import_file')}}" enctype='multipart/form-data'>
        @csrf

        <div class="custom-file">
            <input type="file" class="custom-file-input" name="import_file" id="importFile" required>
            <label class="custom-file-label" for="importFile">
                Upload a file
            </label>
        </div>
    
        <div class="mt-2">
            <button type="submit" class="btn btn-success">
                Import Books
            </button>
        </div>

    </form>
    
</div>
@endsection