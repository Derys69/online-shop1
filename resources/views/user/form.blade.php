@extends('layouts.app')

@section('content')
<div class="container">
    <form method="post" class="was-validated">
        @csrf

        <div class="mb-3">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-select" required>
                <option value="" disabled selected>Pilih role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->value }}" @selected((old('role', $user->role->value ?? '') == $role->value))>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>

        @empty($user)
        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation">Konfirmasi Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
        </div>
        @endempty

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('user.list') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
@endsection
