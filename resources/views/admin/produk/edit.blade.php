@extends('admin.layout.main')
@section('contentadmin')
<h3>Edit Produk</h3>
        <form action="{{ route('admin.produk.update', $produk->id) }}" method="post">
         @csrf 
         @method('PUT')
         <div class="form-group">
            <label for="">Nama Produk</label>
            <input type="text" name="name" id="name" value="{{ $produk->name }}">
        </div>
         <div class="form-group">
            <label for="">Kategori</label>
           <select name="category_id" id="">
               @foreach ($categories as $category)
                   <option value="{{ $category->id }}" {{ ($category->id == $category->category_id) ? 'selected' : '' }}>{{ $category->name }}</option>
               @endforeach
           </select>
        </div>
         <div class="form-group">
            <label for="">Supplier</label>
           <select name="supplier_id" id="">
               @foreach ($suppliers as $supplier)
                   <option value="{{ $supplier->id }}"  {{ ($supplier->id == $supplier->supplier_id) ? 'selected' : '' }}>{{ $supplier->name }}</option>
               @endforeach
           </select>
        </div>
         <div class="form-group">
            <label for="">Sku Produk</label>
            <input type="text" name="sku" id="sku" value="{{ $produk->sku }}">
        </div>
        <div class="form-group">
             <label for="">Deskripsi</label>
             <textarea name="description" id="description" value="{{ $produk->description }}"></textarea>
        </div>
         <div class="form-group">
            <label for="">Harga Beli</label>
            <input type="number" name="purchase_price" id="purchase_price" value="{{ $produk->purchase_price }}">
        </div>
         <div class="form-group">
            <label for="">Harga Jual</label>
            <input type="number" name="selling_price" id="selling_price" value="{{ $produk->selling_price }}">
        </div>
         <div class="form-group">
            <label for="">Gambar</label>
            <input type="text" name="name" id="name" value="{{ $produk->image }}">
        </div>
         <div class="form-group">
            <label for="">Minimum stock</label>
            <input type="number" name="minimum_stock" id="minimum_stock" value="{{ $produk->minimum_stock }}">
        </div>
         <button type="submit" class="submit-btn">Update</button>
        </form>
        
@endsection