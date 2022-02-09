@extends('layouts.app')



@section('content')
    <div class="container">
        <h1 class="alert alert-danger text-center">Record not found</h1>
        <a class='text-danger text-center' href="{{ route('status') }}">back</a>
    </div>
@endsection
