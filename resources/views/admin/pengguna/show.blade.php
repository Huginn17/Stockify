@extends('admin.layout.main')
@section('contentadmin')
 <h3>Detail Pengguna</h3>
        <table>
            <tbody>
                  <tr>
                    <td>Nama</td>
                    <td width="2px"></td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td width="2px"></td>
                    <td>{{ $user->role }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td width="2px"></td>
                    <td>{{ $user->email }}</td>
                </tr>
            </tbody>
        </table>
@endsection