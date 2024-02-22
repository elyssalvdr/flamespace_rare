@extends('layouts.layouts')
@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-8">
        <div>
            @include('layouts.sidebar')
        </div>

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Add New Room
                </div>
                <div class="float-end">
                    <a href="{{ route('rooms.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('rooms.store') }}" method="post">
                    @csrf

                    <div class="mb-3 row">
                        <label for="code" class="col-md-4 col-form-label text-md-end text-start">Room</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code"
                                name="code" value="{{ old('code') }}">
                            @if ($errors->has('code'))
                            <span class="text-danger">{{ $errors->first('code') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="building" class="col-md-4 col-form-label text-md-end text-start">Building</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('building') is-invalid @enderror" id="building"
                                name="building" value="{{ old('building') }}">
                            @if ($errors->has('building'))
                            <span class="text-danger">{{ $errors->first('building') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="capacity" class="col-md-4 col-form-label text-md-end text-start">Capacity</label>
                        <div class="col-md-6">
                            <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                id="capacity" name="capacity" value="{{ old('capacity') }}">
                            @if ($errors->has('building'))
                            <span class="text-danger">{{ $errors->first('capacity') }}</span>
                            @endif
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label for="description"
                            class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description"
                                name="description">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <span class="text-danger">{{ $errors->first('description') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Room">
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection