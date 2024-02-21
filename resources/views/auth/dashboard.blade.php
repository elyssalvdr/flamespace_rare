@extends('auth.layouts')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div >
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                    @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection