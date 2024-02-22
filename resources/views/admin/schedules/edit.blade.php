@extends('layouts.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">

        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Schedule
                </div>
                <div class="float-end">
                    <a href="{{ route('schedules.index') }}" class="col-md-3 offset-md-5 btn btn-primary"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('schedules.update', $schedules->id) }}" method="post">
                    @csrf
                    @method("PUT")

                    <div class="mb-3 row">
                        <label for="id" class="col-md-4 col-form-label text-md-end text-start">ID</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('id') is-invalid @enderror" id="id"
                                name="id" value="{{ $schedules->id }}">
                            @if ($errors->has('id'))
                            <span class="text-danger">{{ $errors->first('id') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Schedule Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ $schedules->title }}">
                            @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="building" class="col-md-4 col-form-label text-md-end text-start">Building</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('building') is-invalid @enderror"
                                id="building" name="building" value="{{ $schedules->building }}">
                            @if ($errors->has('building'))
                            <span class="text-danger">{{ $errors->first('building') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="start_time" class="col-md-4 col-form-label text-md-end text-start">Start Time</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('start_time') is-invalid @enderror" id="start_time"
                                name="start_time" value="{{ old('start_time') }}">
                            @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('start_time') }}</span>
                            @endif
                        </div>
                    </div>
            
                    <div class="mb-3 row">
                        <label for="end_time" class="col-md-4 col-form-label text-md-end text-start">End Time</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time"
                                value="{{ old('end_time') }}">
                            @if ($errors->has('title'))
                            <span class="text-danger">{{ $errors->first('end_time') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection