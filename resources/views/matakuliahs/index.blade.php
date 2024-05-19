@extends('layouts.backend') @section('title','Halaman Dashboard') @section('content')
<div class="card">
    <div class="card-header">Mata Kuliah List</div>
    <div class="card-body">
        @can('create-matakuliah')
        <a href="{{ route('matakuliahs.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New matakuliah</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($matakuliahs as $matakuliah)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $matakuliah->name }}</td>
                    <td>{{ $matakuliah->description }}</td>
                    <td>
                        <form action="{{ route('matakuliahs.destroy',
$matakuliah->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('matakuliahs.show', $matakuliah->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                            @can('edit-matakuliah')
                            <a href="{{ route('matakuliahs.edit',
$matakuliah->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan
                            @can('delete-matakuliah')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this matakuliah?');"><i class="bi bi-trash"></i> Delete</button>
                            @endcan
                        </form>
                    </td>
                </tr>
                @empty
                <td colspan="4">
                    <span class="text-danger">
                        <strong>No matakuliah Found!</strong>
                    </span>
                </td>
                @endforelse
            </tbody>
        </table>
        {{ $matakuliahs->links() }}
    </div>
</div>
@endsection
