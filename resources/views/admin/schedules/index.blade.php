@extends('layouts.layouts')

@section('content')


<div class="row justify-content-center mt-3">
    <div class="col-md-12">
        <div>
            @include('layouts.sidebar')
        </div>

        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">Schedules</div>
            <div class="card-body">
                <a href="{{ route('schedules.create') }}" class="col-md-3 offset-md-5 btn btn-primary "><i
                        class="bi bi-plus-circle"></i> Add New Schedule</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Start Time</th>
                            <th scope="col">End Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedules)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $schedules->id }}</td>
                            <td>{{ $schedules->title }}</td>
                            <td>{{ $schedules-> start_time }}</td>
                            <td>{{ $schedules-> end_time }}</td>

                            <td>
                                <form action="{{ route('schedules.destroy', $schedules->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('schedules.show', $schedules->id) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>Show</a>

                                    <a href="{{ route('schedules.edit', $schedules->id) }}"
                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>Edit</a>

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Do you want to delete this schedule?');"><i
                                            class="bi bi-trash"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="6">
                            <span class="text-danger">
                                <strong>No Schedule Found!</strong>
                            </span>
                        </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $schedules->links() }}

            </div>
        </div>
    </div>
</div>

@endsection