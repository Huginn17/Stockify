@extends('admin.layout.main')
@section('contentadmin')
<h3>Detail Data Supplier</h3>
        <table>
            <tbody>
                <tr>
                    <td width="150px">Nama Supplier</td>
                    <td width="2px"></td>
                    <td>{{ $supplier->name }}</td>
                </tr>
                <tr>
                    <td width="150px">Alamat</td>
                    <td width="2px"></td>
                    <td>{{ $supplier->address }}</td>
                </tr>
                <tr>
                    <td width="150px">No.Tlp</td>
                    <td width="2px"></td>
                    <td>{{ $supplier->phone }}</td>
                </tr>
                <tr>
                    <td width="150px">Email</td>
                    <td width="2px"></td>
                    <td>{{ $supplier->email }}</td>
                </tr>
            </tbody>
        </table>
@endsection