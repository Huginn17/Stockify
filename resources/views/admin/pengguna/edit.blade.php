@extends('admin.layout.main')
@section('contentadmin')
    <div class="">
        <div class="w-full mx-auto p-6 bg-gray-800 sm:rounded-lg shadow-md">
            <h3 class="text-white font-semibold mb-6">Edit Pengguna ✏️</h3>
            <br>


            <form action="{{ route('admin.pengguna.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block font-medium text-white mb-2">Nama : </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 bg-gray-50 transition duration-300 hover:bg-gray-200"
                        required>
                </div>


                <div class="mb-4">
                    <label for="role" class="block font-medium text-white mb-2">Role : </label>
                    <select name="role" id="role"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 bg-gray-50 transition duration-300 hover:bg-gray-200"
                        required>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="manajer_cabang" {{ old('role', $user->role) == 'manajer_cabang' ? 'selected' : '' }}>
                            Manajer Cabang</option>
                        <option value="staff_gudang" {{ old('role', $user->role) == 'staff_gudang' ? 'selected' : '' }}>
                            Staff Gudang</option>
                    </select>
                </div>


                <div class="mb-4">
                    <label for="email" class="block font-medium text-white mb-2">Email : </label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 bg-gray-50 transition duration-300 hover:bg-gray-200"
                        required>
                </div>


                <div class="mb-4">
                    <label for="password" class="block font-medium text-white mb-2">Password Baru : </label>
                    <input type="password" name="password" id="password"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring focus:border-blue-300 bg-gray-50 transition duration-300 hover:bg-gray-200"
                        placeholder="Kosongkan jika tidak ingin mengganti">
                </div>


                <div class="pt-4 flex justify-between items-center">
                    <button type="submit" style="border-radius: 20vh"
                        class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md transition duration-200">
                        Perbarui Pengguna
                    </button>

                    <a href="{{ route('admin.pengguna.index') }}"
                        class="bg-orange-500 hover:bg-orange-400 text-white font-bold py-2 px-4 rounded-md transition duration-200"
                        style="border-radius: 20vh; text-decoration: none;">
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
