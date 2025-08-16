@extends('admin.layout.main')
@section('contentadmin')
    <h3>Edit Pengguna</h3>

    <form action="{{ route('admin.pengguna.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manajer_cabang" {{ old('role', $user->role ?? '') == 'manajer_cabang' ? 'selected' : '' }}>
                    Manajer Cabang</option>
                <option value="staff_gudang" {{ old('role', $user->role ?? '') == 'staff_gudang' ? 'selected' : '' }}>Staff
                    Gudang</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" id="email" value="{{ $user->email }}">
        </div>
        {{-- <div class="form-group">
            <label for="">Password</label>
            <input type="password" name="password" id="password" value="{{ $user->password }}">
        </div> --}}
        <button type="submit" class="submit-btn">Update</button>
    </form>
@endsection
