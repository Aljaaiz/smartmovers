@extends('layouts.base')

@section('content')
<div class="col-md-6 my-4 p-4 mx-auto bg-dark   justify-content-center align-items-center">
<h1 class="text-white text-center">Check Status</h1>
<div class="row">
<div class="col-md-12">
<form action="/statusq/{ccode}" method="GET" autocomplete="off">
        @csrf
        @error('ccode')
            <h4 class="text-danger text-center">
            {{ $message }}
            </h4>
        @enderror
        <input type="text" name="ccode" class="form-control btn-lg mb-3" placeholder="Input your application code">
        <button type="submit" class="btn btn-primary d-grid gap-2 col-6 mx-auto mb-4 py-2">Search</button>
</form>
        @if(!empty($singleMover ))
        <div class="card col-sm-12">
            <div class="card-body">
            <h3 class="alert alert-info text-center">{{ $singleMover->permissionStatus}}</h3>
        <ul class="list-group text-center">


            <li class="list-group-item"><h5 class="d-inline-block text-muted">Items to Move: </h5><h4>{{$singleMover->movingItems }}</h4></li>

            <li class="list-group-item"><h5 class="d-inline-block text-muted">Apartment/Office: </h5> <h4 class="text-bold">{{ $singleMover->apartmentNo}}</h4></li>


            <li class="list-group-item"><h5 class="d-inline-block text-muted">Moving Type : </h5><h4>{{$singleMover->movingtype}}</h4></li>

            {{-- <li class="list-group-item">Moving Items :{{ $singleMover->movingItems}}</li>
            <li class="list-group-item">Moving Type:{{ }}</li> --}}
        </ul>


           {{-- {{ auth()->user()->name  }}
        {{ $name ? 'yes' : 'no' }}
                <h5 class="my-3">Signed by: </h5> --}}
                <h6 class="my-3 ">{{ $singleMover->updated_at }}</h6>
        @else
            {{-- {{ $error }} --}}
            {{-- @error('error')
                {{ $message }}
            @enderror --}}
        </div>
        </div>

  @endif
</div>
</div>    
</div>
</div>
</div>
@endsection
