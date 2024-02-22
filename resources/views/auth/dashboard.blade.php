@extends('layouts.layouts')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div >
            @include('layouts.sidebar')
        </div>
        <div class="dashboard-container">
            <div class="dashboard-card">
                <div class="dashboard-header">Dashboard</div>
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