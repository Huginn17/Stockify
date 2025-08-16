@extends('admin.layout.main')
@section('contentadmin')
<h3>Edit Attribut</h3>
        <form action="{{ route('admin.attribut.update', $attribut->id) }}" method="post">
         @csrf 
         @method('PUT')
         <div class="form-group">
            <label for="">Produk</label>
           <select name="product_id" id="">
               @foreach ($products as $produk)
                   <option value="{{ $produk->id }}" {{ ($produk->id == $produk->product_id) ? 'selected' : '' }}>{{ $produk->name }}</option>
               @endforeach
           </select>
        </div>
         <div class="form-group">
            <label for="">Attribut</label>
            <input type="text" name="name" id="name" value="{{ $attribut->name }}">
        </div>
         <div class="form-group">
            <label for="">Value</label>
            <input type="text" name="value" id="value" value="{{ $attribut->value }}">
        </div>
         <button type="submit" class="submit-btn">Update</button>
        </form>
        
@endsection