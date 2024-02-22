@extends('layouts.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Room Information
                </div>
                <div class="float-end">
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <label for="code"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Number:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $rooms->code }}
                    </div>
                </div>

                <div class="row">
                    <label for="name"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $rooms->name }}
                    </div>
                </div>

                <div class="row">
                    <label for="building"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>building:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $rooms->building }}
                    </div>
                </div>

                <div class="row">
                    <label for="capacity"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Capacity:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $rooms->capacity }}
                    </div>
                </div>

                <div class="row">
                    <label for="description"
                        class="col-md-4 col-form-label text-md-end text-start"><strong>Description:</strong></label>
                    <div class="col-md-6" style="line-height: 35px;">
                        {{ $rooms->description }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection