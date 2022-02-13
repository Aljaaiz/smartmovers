@extends('layouts.app')


@section('content')
    {{-- <div class="container tbback"> --}}
    <div class="container">
        <div class="col  bg-white">
            <h2 class="text-center py-3 bg-dark text-white">DASHBOARD</h2>
        </div>
    </div>
    <div class="container" id="dashboard-header">
        <div class="col-8 mx-auto">
            <div class="bg-light my-3  d-flex justify-content-center">
                <form action="" method="POST">
                    @csrf
                    <input class="form-control d-block" type="text" name="ccode" id="dashSearch" placeholder="Search records"
                        w-100>
                    {{-- <button class="btn  btn-info btnSearch">Search</button> --}}
                </form>
            </div>
        </div>
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
                    <tbody id="tbody-row">
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
                            <td data-label="Action"><a class="action btn btn-info text-white fw-bold"
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
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
            $('body').on('keyup', '#dashSearch', function() {
                let value = $(this).val();
                $('#tbody-row').html('')
                console.log(value);
                $.ajax({
                    url: ' {{ route('dashboardSearch') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        value: value

                    },
                    dataType: 'json',
                    success: function(res) {
                        var output = ''
                        // $('#tbody-row').html('')

                        $.each(res, function(index, data) {
                            console.log(data);
                            output = ` <tr>
                            {{-- <td>{{ $mover['id'] }}</td> --}}
                            <td data-label="Apartment No.">${data.apartmentNo}</td>
                            <td data-label="Name">${data.name}</td>
                            <td data-label="Moving Items">${data.movingItems}</td>
                            <td data-label="Moving Type">${data.movingtype}</td>
                            <td data-label="Apartment No.">${data.date_time}</td>
                            <td data-label="Movers Company">${data.moverscompany}</td>
                            <td data-label="Email">${data.email}</td>
                            <td data-label="Phone Number.">${data.pnumber}</td>
                            <td data-label="Created_at">${data.name}</td>
                            <td data-label="Permission Status">${data.permissionStatus}</td>
                            <td data-label="Action"><a class="action btn btn-info text-white fw-bold"
                                    href="/details/${data.ccode}">Action</a></td>
                        </tr>`
                            $('#tbody-row').append(output);
                        })

                    },
                    error: function(err) {

                    }
                })
            });
        })
    </script>
@endsection
