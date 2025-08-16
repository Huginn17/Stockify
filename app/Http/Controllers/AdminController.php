<?php

namespace App\Http\Controllers;

use App\Models\Attribut;
use App\Models\Categories;
use App\Models\Produk;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    //PRODUK
    public function produk()
    {
        $allproduk = Produk::all();
        return view('admin.produk.index', compact('allproduk'));
    }

    public function create_produk()
    {
        $suppliers = Suppliers::all();
        $categories = Categories::all();
        $product_attributes = Attribut::all();
        return view('admin.produk.create', compact('suppliers', 'categories', 'product_attributes'));
    }

    public function store_produk(Request $request)
    {
        $validatedData = $request->validate([
            'name'           => 'required',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:categories,id',
            'sku'            => 'nullable',
            'description'    => 'nullable',
            'purchase_price' => 'required',
            'selling_price'  => 'required',
            'image'          => 'nullable||mimes:jpg,png,jpeg',
            'minimum_stock'  => 'required'
        ]);


        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('product-image', 'public');
        }



        //simpan data
        Produk::create($validatedData);

        //redirect ke index
        return redirect()->route('admin.produk');
    }

    public function show_produk(Produk $produk)
    {
        return view('admin.produk.show', compact('produk'));
    }

    public function edit_produk(Produk $produk)
    {
        $suppliers = Suppliers::all();
        $categories = Categories::all();
        $product_attributes = Attribut::all();
        return view('admin.produk.edit', compact('produk', 'suppliers', 'categories', 'product_attributes'));
    }

    public function update_produk(Request $request, Produk $produk)
    {
        $validatedData = $request->validate([
            'name'           => 'required',
            'category_id'    => 'required',
            'supplier_id'    => 'required',
            'sku'            => 'nullable',
            'description'    => 'nullable',
            'purchase_price' => 'required',
            'selling_price'  => 'required',
            'image'          => 'nullable||mimes:jpg,png,jpeg',
            'minimum_stock'  => 'required',
        ]);

        //update data
        $produk->update($validatedData);

        //redirect ke index
        return redirect()->route('admin.produk');
    }

    public function destroy_produk(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk');
    }










    //KATEGORI
    public function kategori()
    {
        $allkategori = Categories::all();
        return view('admin.kategori.index', compact('allkategori'));
    }

    public function create_kategori()
    {
        return view('admin.kategori.create');
    }

    public function store_kategori(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable'
        ]);

        //simpan data
        Categories::create($validatedData);

        //redirect ke index
        return redirect()->route('admin.kategori.index');
    }

    public function show_kategori(Categories $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    public function edit_kategori(Categories $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update_kategori(Request $request, Categories $kategori)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable'
        ]);

        //update data
        $kategori->update($validatedData);

        //redirect ke index
        return redirect()->route('admin.kategori.index');
    }

    public function destroy_kategori(Categories $kategori)
    {
        $kategori->delete();
        return redirect()->route('admin.kategori.index');
    }









    //Supplier
    public function supplier()
    {
        $allsupplier = Suppliers::all();
        return view('admin.supplier.index', compact('allsupplier'));
    }

    public function create_supplier()
    {
        return view('admin.supplier.create');
    }

    public function store_supplier(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'address' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
        ]);

        //simpan data
        Suppliers::create($validatedData);

        //redirect ke index
        return redirect()->route('admin.supplier.index');
    }

    public function destroy_supplier(Suppliers $supplier) //$id)
    {
        $supplier->delete();
        return redirect()->route('admin.supplier.index');
    }

    public function edit_supplier(Suppliers $supplier) //Request //$request,$id)
    {
        return view('admin.supplier.edit', compact('supplier'));
    }

    public function update_supplier(Request $request, Suppliers $supplier)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'address' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
        ]);

        //update data
        $supplier->update($validatedData);

        //redirect ke index
        return redirect()->route('admin.supplier.index');
    }

    public function show_supplier(Suppliers $supplier)
    {
        return view('admin.supplier.show', compact('supplier'));
    }









    //Attribut
    public function attribut()
    {
        $allattribut = Attribut::all();
        return view('admin.attribut.index', compact('allattribut'));
    }

    public function create_attribut()
    {
        $products = Produk::all();
        return view('admin.attribut.create', compact('products'));
    }

    public function store_attribut(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required|max:100',
            'value' => 'required'
        ]);

        //simpan data
        Attribut::create($validatedData);

        //redirect ke index
        return redirect()->route('admin.attribut.index');
    }

    public function show_attribut(Attribut $attribut)
    {
        return view('admin.attribut.show', compact('attribut'));
    }

    public function edit_attribut(Attribut $attribut)
    {
        $products = Produk::all();
        return view('attribut.edit', compact('attribut', 'products'));
    }
    public function update_attribut(Request $request, Attribut $attribut)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required|max:100',
            'value' => 'required'
        ]);

        //update data
        $attribut->update($validatedData);

        //redirect ke index
        return redirect()->route('admin.attribut.index');
    }

    public function destroy_attribut(Attribut $attribut)
    {
        $attribut->delete();
        return redirect()->route('admin.attribut.index');
    }








    //Pengguna
    public function pengguna()
    {
        $allpengguna = User::all();
        return view('admin.pengguna.index', compact('allpengguna'));
    }

    public function create_pengguna()
    {
        $users = User::all();
        return view('admin.Pengguna.create', compact('users'));
    }


    public function store_pengguna(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|max:100',
            'role' => 'required',
            'password' => 'required'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }


        //simpan data
        User::create($validatedData);

        //redirect ke index
        return redirect()->route('admin.pengguna.index');
    }

    public function show_pengguna(User $user)
    {
        return view('admin.pengguna.show', compact('user'));
    }

    public function edit_pengguna(User $user)
    {
        $users = User::all();
        return view('admin.pengguna.edit', compact('user'));
    }

    public function update_pengguna(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|max:100',
            'role' => 'required',
            'password' => 'nullable'
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }


        //update data
        $user->update($validatedData);

        //redirect ke index
        return redirect()->route('admin.pengguna.index');
    }

    public function destroy_pengguna(User $user)
    {
        $user->delete();
        return redirect()->route('admin.pengguna.index');
    }
}
