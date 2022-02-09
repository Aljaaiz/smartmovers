@extends('layouts.app')


@section('content')
    {{-- <div class="container tbback"> --}}
    <div class="container">
        <div class="col  bg-white">
            <h2 class="text-center py-3">DASHBOARD</h2>
        </div>
    </div>
    <div class="container" id="dashboard-header">

        {{-- <div class="bg-light my-3 p-3 d-flex justify-content-center">
            <form action="" method="GET">
                @csrf
                <input type="text" name="input ccode">
                <button class="btn  btn-info">Search</button>
            </form>
        </div> --}}
    </div>
    <div class="container">
        <div class="">
            <table class="table table-bordered text-center my-5 py-5 bg-light" id="table">
                <thead class="table-dark fw-bold">
                    <tr>
                        {{-- <th class="fw-bold">SN</th> --}}
                        <th>Floor No</th>
                        <th>Name</th>
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
                            {{-- <td>{{ $mover['id'] }}</td> --}}
                            <td data-label="Apartment No.">{{ $mover['apartmentNo'] }}</td>
                            <td data-label="Name">{{ $mover['name'] }}</td>
                            <td data-label="Moving Items">{{ $mover['movingItems'] }}</td>
                            <td data-label="Moving Type">{{ $mover['movingtype'] }}</td>
                            <td data-label="Apartment No.">{{ $mover['date_time'] }}</td>
                            <td data-label="Movers Company">{{ $mover['moverscompany'] }}</td>
                            <td data-label="Email">{{ $mover['email'] }}</td>
                            <td data-label="Phone Number.">{{ $mover['pnumber'] }}</td>
                            <td data-label="Created_at">{{ $mover['created_at'] }}</td>
                            <td data-label="Permission Status">{{ $mover['permissionStatus'] }}</td>
                            <td data-label="Action"><a class="action"
                                    href="/details/{{ $mover['ccode'] }}">Action</a></td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
            {{ $movers->links() }}
        </div>
    </div>

    {{-- </div> --}}

@endsection
