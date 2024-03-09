@extends('layouts.layouts')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div >
            @include('layouts.sidebar')
        </div>
        <div class="dashboard-header">Dashboard</div>
        <div class="dashboard-container">
            
            <div class="dashboard-card">
                <div class="dash-card">
                    <div class="dash-card-body">
                        <div class="dcard-header">Total Available Rooms:</div>
                        <div class="dcard">{{ $available_rooms_count }}</div>
                    </div>
                    <div class="dash-card-body">
                        <div class="dcard-header">Total Reserved Rooms:</div>
                        <div class="dcard">{{ $reserved_rooms_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection