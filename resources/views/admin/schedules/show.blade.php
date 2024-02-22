@extends('layouts.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Schedule Information
                </div>
                <div class="float-end">
                    <a href="{{ route('schedules.index') }}" class="col-md-3 offset-md-5 btn btn-primary">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="id"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>ID:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $schedules->id }}
                    </div>
                </div>

                <div class="row">
                    <label for="title"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Schedule Title:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $schedules->title }}
                    </div>
                </div>

                <div class="row">
                    <label for="start_time"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Start Time:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $schedules->start_time }}
                    </div>
                </div>

                <div class="row">
                    <label for="end_time"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>End Time:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $schedules->end_time }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection