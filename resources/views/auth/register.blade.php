@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card-login">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form action="{{ route('store') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <input type="text" class="form-control-login @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" placeholder="Name">
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <input type="email" class="form-control-login @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email') }}" placeholder="Email">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <input type="password" class="form-control-login @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <input type="password" class="form-control-login" id="password_confirmation"
                                name="password_confirmation" placeholder="Password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Register">
                    </div>
                    <div class="text-center">
                        <p>Already registered? <a class="link-text" href="{{ route('login') }}">Login here</a></p>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection