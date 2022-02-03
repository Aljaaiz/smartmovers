@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-10 mx-auto sm-12  bg-inverse">
            <div class="form-div">
                <h3 class="text-center">Please fill in the field below for your moving request</h3>
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-6 py-4 justify-content-center align-items-center">

                        <form action="{{ route('store') }}" method="POST">

                            @csrf

                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control shadow-none"
                                        value="{{ old('name') }}">
                                    @error('name')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-3">
                                    <label for="name">Phone number</label>
                                    <input type="number" name="pnumber" class="form-control shadow-none"
                                        value="{{ old('pnumber') }}">
                                    @error('pnumber')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div id="picker"> </div>
                                <input type="hidden" id="result" value="">
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="name">Email</label>
                                    <input type="email" name="email" class="form-control shadow-none"
                                        value="{{ old('email') }}">
                                    @error('email')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="" class="d-block">Commercial/Apartment</label>
                                    <select name="apttype" id="aptType" class="form-control shadow-none">
                                        <option value="office">office</option>
                                        <option value="apartment">residence</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Office/Apartemt no.</label>
                                    <input type="number" name="apartmentNo" class="form-control"
                                        value="{{ old('apartmentNo') }}">
                                    @error('apartmentNo')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Moving Type</label>
                                    <select name="movingtype" class="mb-2 form-control shadow-none">
                                        <option value="move-in">move-in</option>
                                        <option value="move-out">move-out</option>
                                        <option value="Delivery">Delivery</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Date and Time</label>
                                    <input class="form-control shadow-none" rows="2" name="date_time" id="move_at">
                                    @error('date_time')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Movers Company</label>
                                    <textarea class="form-control shadow-none" rows="2" name="moverscompany"></textarea>
                                    @error('moverscompany')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group mb-3">
                                    <label for="">Items to be moved</label>
                                    <textarea class="form-control shadow-none" rows="4" name="movingItems"
                                        placeholder="Items to be moved"> </textarea>
                                    @error('movingItems')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn  btn-info btn-block py-3 text-white">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#move_at', {
            enableTime: true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
