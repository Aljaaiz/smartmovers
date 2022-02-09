@extends('layouts.app')


@section('content')
    <div class="container my-5">
        <h3 class="m-3 text-center fw-500 text-white">Tenant Confirmation Page</h3>
        <table class="table table-bordered text-center bg-light">
            <thead class="table-dark">
                <tr>
                    <th>Ccode</th>
                    <th>Name</th>
                    <th>Apt/Office No</th>
                    <th>Items to Move</th>
                    <th>Moving Type</th>
                    <th>Date and Time</th>
                    <th>Email</th>
                    <th>Phone No.</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            {{-- @foreach ($singleMover as $mover) --}}
            <tbody>
                <tr>
                    <td>{{ $singleMover->ccode }}</td>
                    <td>{{ $singleMover->name }}</td>
                    <td>{{ $singleMover->apartmentNo }}</td>
                    <td>{{ $singleMover->movingItems }}</td>
                    <td>{{ $singleMover->movingtype }}</td>
                    <td>{{ $singleMover->date_time }}</td>
                    <td>{{ $singleMover->email }}</td>
                    <td>{{ $singleMover->pnumber }}</td>
                    <td id="permission">{{ $singleMover->permissionStatus }}</td>
                    <td>
                        <form action="/update/{id}/{statusValue}" method="POST">
                            @csrf
                            <select name="status" class="status" id="{{ $singleMover->id }}">
                                <option value="">---Choose---</option>
                                <option value="Approved">Approved</option>
                                <option value="Not Allow">Not Allow</option>
                                <option value="Check with Office">Check with Office</option>
                                <option value="Pending">Pending</option>
                            </select>
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {

            $('.status').change(function() {
                var statusValue = $('.status').val()
                let id = $('.status').attr('id');
                // console.log(id,statusValue)


                $.ajax({
                    url: '/update/' + id + '/' + statusValue,
                    type: 'POST',
                    datatype: 'json',

                    data: JSON.stringify({
                        _token: '{{ csrf_token() }}',
                        // _method:'PUT',
                        'id': id,
                        'statusValue': statusValue,
                    }),
                    contentType: 'application/json ,charset=UTF-8',
                    success: function(res) {
                        $('#permission').text(res.permissionStatus)
                        // console.log(data)
                        // location.reload();
                    },
                    error: function(err) {
                        console.log(err)
                    }

                })

            })

        })
    </script>
@endsection
