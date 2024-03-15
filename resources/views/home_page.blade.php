@extends('layout')

@section('title')
    test Nux Game
@endsection

@section('content')
    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['route' => 'user.store']) !!}
                        <form style="width: 500px">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phonenumber" class="form-control" id="phone" placeholder="Enter phone number">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block mt-2">Register</button>
                        </form>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
