@extends('layouts.app')
@section('content')
<div class="card">
    <div class="card-header">Manage Mahasiswa</div>
    <div class="card-body">
        @can('create-mahasiswa')
        <a href="{{ route('mahasiswas.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Mahasiswa</a>
        @endcan
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">S#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Roles</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($mahasiswas as $mahasiswa)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $mahasiswa->name }}</td>
                    <td>{{ $mahasiswa->email }}</td>
                    <td>
                        @forelse ($mahasiswa->getRoleNames() as $role)
                        <span class="badge bg-primary">{{ $role
}}</span>
                        @empty
                        @endforelse
                    </td>
                    <td>
                        <form action="{{ route('mahasiswas.destroy', $mahasiswa->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('mahasiswas.show', $mahasiswa->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                            @if (in_array('Super Admin',
                            $mahasiswa->getRoleNames()->toArray() ?? []) )
                            @if (Auth::user()->hasRole('Super Admin'))
                            <a href="{{ route('mahasiswas.edit',
$mahasiswa->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                            @else
                            @can('edit-mahasiswa')
                            <a href="{{ route('mahasiswas.edit',
$mahasiswa->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                            @endcan
                            @can('delete-mahasiswa')
                            @if (Auth::user()->id!=$mahasiswa->id)
                            <button type="submit" class="btn
btn-danger btn-sm" onclick="return confirm('Do you want to delete this mahasiswa?');"><i class="bi bi-trash"></i> Delete</button>
                            @endif
                            @endcan
                            @endif
                        </form>
                    </td>
                </tr>
                @empty
                <td colspan="5">
                    <span class="text-danger">
                        <strong>No User Found!</strong>
                    </span>
                </td>
                @endforelse
            </tbody>
        </table>
        {{ $mahasiswas->links() }}
    </div>
</div>
@endsection
