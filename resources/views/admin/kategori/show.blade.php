@extends('admin.layout.main')
@section('contentadmin')
<h3>Detail Kategori</h3>
        <table>
            <tbody>
                <tr>
                    <td width="150px">Nama Kategori</td>
                    <td width="2px"></td>
                    <td>{{ $kategori->name }}</td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td width="2px"></td>
                    <td>{{ $kategori->description }}</td>
                </tr>
            </tbody>
        </table>
@endsection