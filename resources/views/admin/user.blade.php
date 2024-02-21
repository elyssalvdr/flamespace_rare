<div class="row justify-content-center mt-5">
    <div class="col-md-8">

        <div class="card-login">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form action="{{ route('authenticate') }}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <!-- <label for="email" class="col-md-4 col-form-label text-md-end text-start">Email Address</label> -->
                        <div class="col-md-6">
                            <input type="email" class="form-control-login @error('email') is-invalid @enderror"
                                id="email" name="email" value="{{ old('email') }}" placeholder="Email">
                            @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <!-- <label for="password" class="col-md-4 col-form-label text-md-end text-start">Password</label> -->
                        <div class="col-md-6">
                            <input type="password" class="form-control-login @error('password') is-invalid @enderror"
                                id="password" name="password" placeholder="Password">
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Login">
                    </div>
                    <div class="text-center">
                        <p>Not registered? <a class="link-text" href="{{ route('register') }}">Create an account.</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>      </div>
        </div>
    </div>
</div>

@endsection