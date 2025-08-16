@extends('admin.layout.main')
@section('contentadmin')
 <h3>Detail Attribut</h3>
        <table>
            <tbody>
                <tr>
                    <td>Produk</td>
                    <td width="2px"></td>
                    <td>{{ $attribut->produk->name }}</td>
                </tr>
                <tr>
                    <td>Attribut</td>
                    <td width="2px"></td>
                    <td>{{ $attribut->name }}</td>
                </tr>
                <tr>
                    <td>Value</td>
                    <td width="2px"></td>
                    <td>{{ $attribut->value }}</td>
                </tr>
            </tbody>
        </table>
@endsection