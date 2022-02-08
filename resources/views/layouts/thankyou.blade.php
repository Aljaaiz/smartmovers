@extends('layouts.app')

@section('content')

    @if (session('ccode'))
        <div id="msg_box" class="py-4"
            style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin:200px auto;background:#000;max-width:450px;color:#fff;border-radius:5px">
            <h3 class="text-success fw-bolder">Thank you</h3>
            <p class="fw-light text-wrap text-center px-2">Your request has been submitted succesfully Check with your
                confirmation code below for follow up</p>
            <p style="fw-bolder font-size:1.2rem">Tracking Code:</p>
            <h3 style="font-size:2rem;letter-spacing:4px" class="fw-bold">{{ session('ccode') }}</h3>


        </div>
    @endif
@endsection
