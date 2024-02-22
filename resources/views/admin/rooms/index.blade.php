@extends('layouts.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-md-12">

        @if ($message = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $message }}
        </div>
        @endif

        <div class="card">
            <div class="card-header">Room List</div>
            <div class="card-body">
                <a href="{{ route('rooms.create') }}" class="btn btn-success btn-sm my-2"><i
                        class="bi bi-plus-circle"></i> Add New Room</a>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">S#</th>
                            <th scope="col">Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Building</th>
                            <th scope="col">Capacity</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rooms as $rooms)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $rooms->code }}</td>
                            <td>{{ $rooms->name }}</td>
                            <td>{{ $rooms->building }}</td>
                            <td>{{ $rooms->capacity }}</td>
                            <td>
                                <form action="{{ route('rooms.destroy', $rooms->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('rooms.show', $rooms->id) }}"
                                        class="btn btn-warning btn-sm"><i class="bi bi-eye"></i>Show</a>

                                    <a href="{{ route('rooms.edit', $rooms->id) }}"
                                        class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i>Edit</a>

                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Do you want to delete this room?');"><i
                                            class="bi bi-trash"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <td colspan="6">
                            <span class="text-danger">
                                <strong>No Room Found!</strong>
                            </span>
                        </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $rooms->links() }}

            </div>
        </div>
    </div>
</div>

@endsection