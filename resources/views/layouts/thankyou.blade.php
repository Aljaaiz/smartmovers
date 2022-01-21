@extends('layouts.base')

@section('content')

@if(session('ccode'))
   <div id="msg_box" class="py-4" style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin:200px auto;background:#000;max-width:450px;color:#fff;border-radius:5px">
    <h4 class="text-success">Thank you</h4>
    <p class="text-bold">Your request has been submitted succesfully</p>
    <p class="px-4">Check with your confirmation code below for follow up</p>
    <p style="font-size:1.2rem">Tracking Code:</p>
    <h3 style="font-size:2rem">{{ session('ccode') }}</h3>
   
   
   </div> 
 @endif
@endsection