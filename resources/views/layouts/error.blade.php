@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="alert alert-danger text-center">
            <h1 class="text-center">Record not found</h1>
            <a style="text-decoration:none" class='fs-4 text-danger text-center' href="{{ route('status') }}">back</a>
        </div>
    </div>
@endsection
