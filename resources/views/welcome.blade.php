@extends('layouts.base')

@section('content')
    

<div class="container">
  <div class=" my-5 py-5 main-div d-flex just-content-center flex-column align-items-center text-center" id="home-container">
    <h1 class="welnote">Welcome to Smart Movers <br/>portals</h1>
    @if(session('msg'))
    <h4 class="alert alert-success">
      <p>{{ session('msg')}}</p>
    </h4>
    @endif
    <p>Moving your Items made easy</p>
    {{-- {{ $ccode }} --}}
    <a class="btn btn-danger btn-lg px-5" href="{{ route('create') }}">Continue</a>
  </div>
</div>
@endsection