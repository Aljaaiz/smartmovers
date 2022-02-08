@extends('layouts.app')

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
                    <input type="text" name="ccode" class="form-control btn-lg mb-3"
                        placeholder="Input your application code">
                    <button type="submit"
                        class="btn btn-primary d-grid gap-2 col-6 mx-auto mb-4 py-2 btn-search">Search</button>
                </form>
                @if (!empty($singleMover))
                    <div class="card col-sm-12">
                        <div class="card-body">
                            @php
                                $status = $singleMover->permissionStatus;
                                switch ($status) {
                                    case 'Approved':
                                        echo "<h3 class='alert alert-success text-center'>$singleMover->permissionStatus</h3>";
                                        break;
                                    case 'Check with Office':
                                        echo "<h3 class='alert alert-warning text-center'>$singleMover->permissionStatus</h3>";
                                        break;
                                
                                    case 'Not Allow':
                                        echo "<h3 class='alert alert-danger text-center'>$singleMover->permissionStatus</h3>";
                                        break;
                                    case 'Pending':
                                        echo "<h3 class='alert alert-info text-center'>$singleMover->permissionStatus</h3>";
                                        break;
                                }
                                
                                // if($singleMover->permissionStatus == 'approved'){
                                //  <h3 class="alert alert-{{ $color = 'success' }} text-center">{{ $singleMover->permissionStatus }}</h3>
                                // }
                                
                            @endphp
                            <ul class="list-group text-center">
                                <li class="list-group-item">
                                    <h5 class="d-inline-block text-muted">Items to be Moved: </h5>
                                    <h4>{{ $singleMover->movingItems }}</h4>
                                </li>

                                <li class="list-group-item">
                                    <h5 class="d-inline-block text-muted">Apartment/Office: </h5>
                                    <h4 class="text-bold">{{ $singleMover->apartmentNo }}</h4>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="d-inline-block text-muted">Moving Type : </h5>
                                    <h4>{{ $singleMover->movingtype }}</h4>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="d-inline-block text-muted">Movers Company : </h5>
                                    <h4>{{ $singleMover->moverscompany }}</h4>
                                </li>
                                <li class="list-group-item">
                                    <h5 class="d-inline-block text-muted">Moving Date : </h5>
                                    <h4>{{ $singleMover->date_time }}</h4>
                                </li>
                            </ul>
                            <h4 class="my-3 text-muted text-center fw-bolder">Updated_by: {{ $singleMover->usr_name }}
                            </h4>
                        @else
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <h4 class="alert alert-danger text-center">Sorry No record</h4>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    {{-- <script>
        let status_error = document.getElementById('status_error');
        status_error.style.display = 'none';
        setTimeout(() => {
            status_error.style.display = 'block';
            status_error.remove()
        }, 2000);
    </script> --}}
@endsection
