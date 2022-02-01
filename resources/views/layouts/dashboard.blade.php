@extends('layouts.app')


@section('content')
{{-- <div class="container tbback"> --}}

<div class="container" id="dashboard-header">
<h2 class="text-center py-3">DASHBOARD</h2>
<div class="bg-light my-3 p-3 d-flex justify-content-center">
  <form action="" method="GET">
    @csrf
    <input type="text" name="input ccode">
    <button class="btn  btn-info">Search</button>
</form>
</div>
</div>
 <div class="container">
<div class="">
<table class="table table-bordered text-center my-5 py-5 bg-light" id="table">
<thead class="table-dark fw-bold">
<tr>
<th class="fw-bold">SN</th>
<th>Name</th>
<th>Floor No</th>
<th>Items to Move</th>
<th>Moving Type</th>
<th>Date and Time</th>
<th>Movers Company</th>
<th>Email</th>
<th>Phone No.</th>
<th>Date Submitted</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
@foreach ($movers as $mover)
<tbody>
<tr>
 <td>{{ $mover['id'] }}</td>
   <td>{{ $mover['name'] }}</td>
   <td>{{ $mover['apartmentNo']}}</td>
   <td>{{ $mover['movingItems']}}</td>
   <td>{{ $mover['movingtype']}}</td>
   <td>{{ $mover['date_time']}}</td>
   <td>{{ $mover['moverscompany']}}</td>
   <td>{{ $mover['email']}}</td>
   <td>{{ $mover['pnumber']}}</td>
   <td>{{ $mover['created_at']}}</td>
   <td>{{ $mover['permissionStatus']}}</td>
   <td><a  class="action" href="/details/{{$mover['ccode']}}">Action</a></td>
</tr>
</tbody>
@endforeach
</table>
{{  $movers->links() }}
</div>
 </div>

{{-- </div> --}}

@endsection

