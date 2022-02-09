@extends('layouts.app')


@section('content')
    <div class="container my-5">
        <div class="col bg-dark text-white py-2 mb-2">
            <h3 class="m-3 text-center fw-500 text-white">Confirmation Page</h3>
        </div>
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
                    <td data-label="Ccode">{{ $singleMover->ccode }}</td>
                    <td data-label="Name">{{ $singleMover->name }}</td>
                    <td data-label="Apartment No">{{ $singleMover->apartmentNo }}</td>
                    <td data-label="Items to be moved">{{ $singleMover->movingItems }}</td>
                    <td data-label="Moving Type">{{ $singleMover->movingtype }}</td>
                    <td data-label="Date">{{ $singleMover->date_time }}</td>
                    <td data-label="Email">{{ $singleMover->email }}</td>
                    <td data-label="Phone No.">{{ $singleMover->pnumber }}</td>
                    <td data-label="Permission Status" id="permission">{{ $singleMover->permissionStatus }}</td>
                    <td data-label="Action">
                        <form action="/update/{id}/{statusValue}" method="POST">
                            @csrf
                            <select name="status" class="status" id="{{ $singleMover->id }}">
                                <option value="">---Select---</option>
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
