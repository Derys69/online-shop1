@extends('layouts.app')

@section('content')
<div class="container">
    <h2>👥 Manajemen Pengguna</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" class="mb-3">
        <input type="text" name="q" class="form-control" placeholder="Cari nama/email..." value="{{ request('q') }}">
    </form>

    <div class="mb-3">
        <a href="{{ route('user.create') }}" class="btn btn-success">➕ Tambah User</a>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Bergabung</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role->name ?? $user->role }}</td>
                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-info btn-sm">✏️ Edit</a>
                    <form method="POST" action="{{ route('user.delete', $user->id) }}" class="d-inline" onsubmit="return confirm('Yakin?')">
                        @csrf
                        <button class="btn btn-danger btn-sm">🗑️ Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
