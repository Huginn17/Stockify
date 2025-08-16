<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Attribut;
use App\Models\Categories;
use App\Models\Produk;
use App\Models\Setting;
use App\Models\StockTransaction;
use App\Models\Suppliers;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        // ambil filter periode
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->subMonths(5)->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->toDateString());

        //awal & akhir hari
        $startDate = Carbon::parse($tanggalMulai)->startOfDay();
        $endDate   = Carbon::parse($tanggalSelesai)->endOfDay();

        // jumlah produk
        $jumlahProduk = Produk::count();

        // jumlah transaksi masuk
        $jumlahMasuk = StockTransaction::where('type', 'masuk')
            ->where('status', 'Diterima')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('quantity');

        // jumlah transaksi keluar
        $jumlahKeluar = StockTransaction::where('type', 'keluar')
            ->where('status', 'Dikeluarkan')
            ->whereBetween('date', [$startDate, $endDate])
            ->sum('quantity');

        // siapkan data grafik
        $periode = collect();
        $masukPeriode = collect();
        $keluarPeriode = collect();

        $start = Carbon::parse($tanggalMulai)->startOfMonth();
        $end   = Carbon::parse($tanggalSelesai)->endOfMonth();

        while ($start <= $end) {
            $labelBulan = $start->translatedFormat('F Y');
            $periode->push($labelBulan);

            $masuk = StockTransaction::where('type', 'masuk')
                ->where('status', 'Diterima')
                ->whereYear('date', $start->year)
                ->whereMonth('date', $start->month)
                ->sum('quantity');

            $keluar = StockTransaction::where('type', 'keluar')
                ->where('status', 'Dikeluarkan')
                ->whereYear('date', $start->year)
                ->whereMonth('date', $start->month)
                ->sum('quantity');

            $masukPeriode->push($masuk);
            $keluarPeriode->push($keluar);

            $start->addMonth();
        }

        $log = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'jumlahProduk',
            'jumlahMasuk',
            'jumlahKeluar',
            'periode',
            'masukPeriode',
            'keluarPeriode',
            'tanggalMulai',
            'tanggalSelesai',
            'log'
        ));
    }





    //PRODUK
    public function produk(Request $request)
    {
        $allproduk = Produk::all();
        $query = Produk::query();

        //filter seacrh
        if (request()->filled('search')) {
            $search = $request->search;
            $query->where(function ($p) use ($search) {
                $p->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($k) use ($search) {
                        $k->where('name', 'like', "%{$search}%");
                    });
            });
        }


        //sorting 
        if (request()->filled('sort')) {
            if (request()->sort == 'name_asc') {
                $query->orderBy('name', 'asc')->get();
            } elseif (request()->sort == 'name_desc') {
                $query->orderBy('name', 'desc')->get();
            }
        }

        $allproduk = $query->get();
        return view('admin.produk.index', compact('allproduk'));
    }

    public function create_produk()
    {
        $suppliers = Suppliers::all();
        $categories = Categories::all();
        $product_attributes = Attribut::all();
        return view('admin.produk.create', compact('suppliers', 'categories', 'product_attributes'));
    }

    public function store_produk(Request $request, Produk $produk)
    {
        $validatedData = $request->validate([
            'name'           => 'required',
            'category_id'    => 'required|exists:categories,id',
            'supplier_id'    => 'required|exists:suppliers,id',
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

        $produk = Produk::create($request->all());
        activity_log(
            'Tambah Produk',
            "Menambahkan produk {$produk->name} (ID : {$produk->id})",
            'produk',
            [
                'product_id' => $produk->id,
                'new_data' => $produk->getAttributes()
            ]
        );

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

        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('produk', 'public');
            $validatedData['image'] = $image;
        }

        activity_log(
            'Ubah Produk',
            "Mengubah produk {$produk->name} (ID: {$produk->id})",
            'produk',
            ['product_id' => $produk->id]
        );



        //update data
        $produk->update($validatedData);

        return redirect()->route('admin.produk');
    }

    public function destroy_produk(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('admin.produk');

        activity_log(
            'Hapus Produk',
            "Menghapus produk {$produk->name} (ID: {$produk->id})",
            'produk',
            ['product_id' => $produk->id]
        );
    }







    //KATEGORI
    public function kategori(Request $request)
    {
        $allkategori = Categories::all();
        $query = Categories::query();

        //filter seac
        if (request()->filled('search')) {
            $search = $request->search;
            $query->where(function ($p) use ($search) {
                $p->where('name', 'like', "%{$search}%");
            });
        }


        //sorting 
        if (request()->filled('sort')) {
            if (request()->sort == 'name_asc') {
                $query->orderBy('name', 'asc')->get();
            } elseif (request()->sort == 'name_desc') {
                $query->orderBy('name', 'desc')->get();
            }
        }

        $allkategori     = $query->get();
        return view('admin.kategori.index', compact('allkategori'));
    }

    public function create_kategori()
    {
        return view('admin.kategori.create');
    }

    public function store_kategori(Request $request, Categories $kategori)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'description' => 'nullable'
        ]);

        //simpan data
        Categories::create($validatedData);

        activity_log(
            'Tambah Kategori',
            "Menambahkan Kategori {$kategori->name} ",
            'Kategori',
            ['category_id' => $kategori->id]
        );


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

        activity_log(
            'Ubah Kategori',
            "Mengubah Kategori {$kategori->name} (ID: {$kategori->id})",
            'Kategori',
            ['category_id' => $kategori->id]
        );


        return redirect()->route('admin.kategori.index');
    }

    public function destroy_kategori(Categories $kategori)
    {
        $kategori->delete();

        activity_log(
            'Hapus Kategori',
            "Menghapus Kategori {$kategori->name} (ID: {$kategori->id})",
            'Kategori',
            ['category_id' => $kategori->id]
        );

        return redirect()->route('admin.kategori.index');
    }









    //Supplier
    public function supplier()
    {
        $allsupplier = Suppliers::all();

        $query = Suppliers::query();

        //filter seac
        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($s) use ($search) {
                $s->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }
        //ambil hasil pencarian
        $allsupplier = $query->get();



        return view('admin.supplier.index', compact('allsupplier'));
    }

    public function create_supplier()
    {
        return view('admin.supplier.create');
    }

    public function store_supplier(Request $request, Suppliers $supplier)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'address' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
        ]);

        activity_log(
            'Tambah Supplier',
            "Menambahkan Supplier {$supplier->name} ",
            'Supplier',
            ['supplier_id' => $supplier->id]
        );

        //simpan data
        Suppliers::create($validatedData);


        return redirect()->route('admin.supplier.index');
    }

    public function destroy_supplier(Suppliers $supplier) //$id)
    {
        $supplier->delete();

        activity_log(
            'Hapus Supplier',
            "Menghapus Supplier {$supplier->name} (ID: {$supplier->id})",
            'Supplier',
            ['supplier_id' => $supplier->id]
        );

        return redirect()->route('admin.supplier.index');
    }

    public function edit_supplier(Suppliers $supplier)
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

        activity_log(
            'Ubah Supplier',
            "Mengubah Supplier {$supplier->name} (ID: {$supplier->id})",
            'Supplier',
            ['supplier_id' => $supplier->id]
        );

        //redirect ke index
        return redirect()->route('admin.supplier.index');
    }

    public function show_supplier(Suppliers $supplier)
    {
        return view('admin.supplier.show', compact('supplier'));
    }









    //Attribut
    public function attribut(Request $request)
    {
        $allattribut = Attribut::all();
        $query = Attribut::query();

        //filter seac
        if (request()->filled('search')) {
            $search = $request->search;
            $query->where(function ($a) use ($search) {
                $a->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhereHas('produk', function ($p) use ($search) {
                        $p->where('name', 'like', "%{$search}%");
                    });
            });
        }


        //sorting 
        if (request()->filled('sort')) {
            if (request()->sort == 'name_asc') {
                $query->orderBy('name', 'asc')->get();
            } elseif (request()->sort == 'name_desc') {
                $query->orderBy('name', 'desc')->get();
            }
        }

        $allattribut = $query->get();
        return view('admin.attribut.index', compact('allattribut'));
    }

    public function create_attribut()
    {
        $products = Produk::all();
        return view('admin.attribut.create', compact('products'));
    }

    public function store_attribut(Request $request, Attribut $attribut)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'name' => 'required|max:100',
            'value' => 'required'
        ]);

        //simpan data
        Attribut::create($validatedData);

        activity_log(
            'Tambah Attribut',
            "Menambahkan Attribut {$attribut->name} ",
            'Attribut',
            ['attribut_id' => $attribut->id]
        );

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
        return view('admin.attribut.edit', compact('attribut', 'products'));
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

        activity_log(
            'Ubah Attribut',
            "Mengubah Attribut {$attribut->name} (ID: {$attribut->id})",
            'Attribut',
            ['attribut_id' => $attribut->id]
        );


        return redirect()->route('admin.attribut.index');
    }

    public function destroy_attribut(Attribut $attribut)
    {
        $attribut->delete();

        activity_log(
            'Hapus Attribut',
            "Menghapus Attribut {$attribut->name} (ID: {$attribut->id})",
            'Attribut',
            ['attribut_id' => $attribut->id]
        );

        return redirect()->route('admin.attribut.index');
    }








    //Pengguna
    public function pengguna()
    {
        $allpengguna = User::all();

        $query = User::query();

        //filter seac
        if (request()->filled('search')) {
            $search = request()->search;
            $query->where(function ($u) use ($search) {
                $u->where('name', 'like', "%{$search}%")
                    ->orWhere('role', 'like', "%{$search}%");
            });
        }
        //ambil hasil penc
        $allpengguna = $query->get();



        return view('admin.pengguna.index', compact('allpengguna'));
    }

    public function create_pengguna()
    {
        $users = User::all();
        return view('admin.Pengguna.create', compact('users'));
    }


    public function store_pengguna(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:100|unique:users,email',
            'role' => 'required',
            'password' => 'required'
        ], [
            'email.unique' => 'Email sudah digunakan, silahkan gunakan email lain',

        ]);


        $validatedData['password'] = Hash::make($request->password);


        //simpan data
        User::create($validatedData);

        activity_log(
            'Tambah Pengguna',
            "Menambahkan Pengguna {$user->name} ",
            'Pengguna',
            ['user_id' => $user->id]
        );


        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna Berhasil Ditambahkan');
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
            'email' => 'required|email|max:100|unique:users,email,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:3',
        ]);

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        activity_log(
            'Ubah Pengguna',
            "Mengubah Pengguna {$user->name} (ID: {$user->id})",
            'Pengguna',
            ['user_id' => $user->id]
        );

        return redirect()->route('admin.pengguna.index')
            ->with('success', 'Pengguna berhasil diperbarui.');
    }



    public function destroy_pengguna(User $user)
    {
        $user->delete();

        activity_log(
            'Hapus Pengguna',
            "Menghapus Pengguna {$user->name} (ID: {$user->id})",
            'Pengguna',
            ['user_id' => $user->id]
        );

        return redirect()->route('admin.pengguna.index');
    }

    public function pengaturan()
    {
        $setting = Setting::all()->pluck('value', 'key');
        return view('admin.pengaturan.index', compact('setting'));
    }

    public function updatepengaturan(Request $request)
    {
        $request->validate([
            'apk_name' => 'required|string',
            'apk_logo' => 'nullable|image|mimes:jpg,png,jpeg',

        ]);

        //update namanya
        Setting::updateOrCreate(
            ['key' => 'apk_name'],
            ['value' => $request->apk_name],
        );

        //update logo 
        if ($request->hasFile('apk_logo')) {
            $logo = $request->file('apk_logo')->store('logos', 'public');
            Setting::updateOrCreate(
                ['key' => 'apk_logo'],
                ['value' => $logo],
            );
        }

        activity_log(
            'Ubah Pengaturan',
            "Mengubah pengaturan umum aplikasi",
            'pengaturan',
            ['changes' => $request->all()]
        );

        return redirect()->back()->with('success', 'Pengaturan Berhasil Diubah');
    }




    //LAPORAN

    public function lapstockbarang(Request $request)
    {

        //ambil bulan sama tahun yang ada transaksinya
        $bulanlist = StockTransaction::selectRaw('MONTH(date) as bulan , YEAR(date) as tahun')
            ->whereIn('status', ['Diterima', 'Dikeluarkan'])
            ->groupByRaw('MONTH(date),YEAR(date)')
            ->orderByRaw('YEAR(date), MONTH(date)')
            ->get();

        //ambil kategorinya
        $kategorilist = Categories::all();
        //ambil semua transaksi terima
        $transaksiterima = StockTransaction::whereIn('status', ['Diterima', 'Dikeluarkan'])->get();


        $kategorilist = Categories::all();

        return view('admin.laporan.stok-barang', compact(
            'bulanlist',
            'transaksiterima',
            'kategorilist',

        ));
    }


    public function lapbarangmasuk(Request $request)
    {
        $lap = StockTransaction::with(['produk.kategori', 'user'])
            ->where('type', 'masuk')
            ->where('status', 'Diterima')
            ->orderBy('date', 'desc');

        //filternya op
        if ($request->filled('tanggal_mulai')) {
            $lap->whereDate('date', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $lap->whereDate('date', '<=', $request->tanggal_selesai);
        }
        $transaksi = $lap->paginate(10);
        return view('admin.laporan.masuk.index', compact('transaksi'));
    }

    public function lapbarangkeluar(Request $request)
    {
        $lap = StockTransaction::with(['produk.kategori', 'user'])
            ->where('type', 'keluar')
            ->where('status', 'Dikeluarkan')
            ->orderBy('date', 'desc');

        //filternya op
        if ($request->filled('tanggal_mulai')) {
            $lap->whereDate('date', '>=', $request->tanggal_mulai);
        }

        if ($request->filled('tanggal_selesai')) {
            $lap->whereDate('date', '<=', $request->tanggal_selesai);
        }
        $transaksi = $lap->paginate(10);
        return view('admin.laporan.keluar.index', compact('transaksi'));
    }




    //RIWAYAT
    public function riwayat(Request $request)
    {
        // ambil transaksi dgn relasi produk sama user
        $ambil = StockTransaction::with(['produk', 'user'])
            ->orderBy('date', 'desc');

        // filter tran
        if ($request->filled('type')) {
            $ambil->where('type', $request->type);
        }

        // fil tgl mulai
        if ($request->filled('tanggal_mulai')) {
            $ambil->whereDate('date', '>=', $request->tanggal_mulai);
        }

        // fil tgl selesai
        if ($request->filled('tanggal_selesai')) {
            $ambil->whereDate('date', '<=', $request->tanggal_selesai);
        }

        $tran = $ambil->paginate(10);
        $produk = Produk::all();

        return view('admin.stock.index', compact('tran', 'produk'));
    }







    //OPNAME 

    public function index2()
    {
        $produk = Produk::with(['stockTransactions' => function ($p) {
            $p->whereIn('status', ['Diterima', 'Dikeluarkan'])
                ->orderBy('created_at', 'desc'); //urutkan transaksi terbaru dulu
        }])->get()->map(function ($produk) {

            // ambil transaksi terakhir
            $lasttr = $produk->stockTransactions->first();

            // tambahkan atribut jumlah_saat_ini dari accessor
            $produk->setAttribute('jumlah_saat_ini', $produk->current_stock);

            // tambahkan atribut perubahan_terakhir
            $produk->setAttribute('perubahan_terakhir', $lasttr ? [
                'quantity' => $lasttr->quantity,
                'type'     => $lasttr->type,
                'date'     => \Carbon\Carbon::parse($lasttr->date)->format('d M Y H:i'),
                'status'   => $lasttr->status,
                'created_at' => $lasttr->created_at->format('d M Y H:i')

            ] : null);

            return $produk;
        });

        return view('admin.stock.opname', compact('produk'));
    }


    public function detail($id)
    {
        $produk = Produk::findorFail($id);

        $transaksi = StockTransaction::where('product_id', $id)
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.stock.show', compact('produk', 'transaksi'));
    }






    //MIN STOCK

    public function minstock()
    {
        //ambil list
        $min = Produk::select('id', 'name', 'sku', 'description', 'purchase_price', 'selling_price', 'image', 'minimum_stock')
            ->withSum(['stockTransactions as masuk_sum' => function ($m) {
                $m->where('type', 'masuk')->where('status', 'Diterima');
            }], 'quantity')
            ->withSum(['stockTransactions as keluar_sum' => function ($m) {
                $m->where('type', 'keluar')->where('status', 'Dikeluarkan');
            }], 'quantity')
            ->orderBy('name');

        $produk = $min->paginate(15)->map(function ($p) {
            $masuk = $p->masuk_sum ?? 0;
            $keluar = $p->keluar_sum ?? 0;
            $p->stock = $masuk - $keluar;
            return $p;
        });
        return view('admin.stock.minstock', compact('produk', 'min'));
    }

    public function updatemin(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'minimum_stock' => 'required|array',
            'minimum_stock.*' => 'required|integer|min:0',
        ]);

        foreach ($validated['minimum_stock'] as $product_Id => $min) {
            $produkitem = Produk::find($product_Id);
            $oldmin = $produkitem->minimum_stock;

            $produkitem->update([
                'minimum_stock' => (int)$min
            ]);
        }

        activity_log(
            'Ubah Minimum Stock',
            "Minimum Stock Produk {$produk->name} (ID: {$produk->id}) diubah dari {$oldmin} menjadi {$min}",
            'minimum_stock',
            [
                'product_id' => $produk->id,
                'old_min' => $oldmin,
                'new_min' => $min
            ]
        );

        return back()->with('success', 'Minimum stock berhasil diupdate');
    }

    public function ningkatmin(Produk $produk)
    {
        $oldmin = $produk->minimum_stock;
        $produk->increment('minimum_stock', 1);


        activity_log(
            'Tambah Minimum Stock',
            "Minimum Stock produk {$produk->name} diubah dari {$oldmin} menjadi " . ($oldmin + 1),
            'minimum_stock',
            [
                'product_id' => $produk->id,
                'old_min' => $oldmin,
                'new_min' => $oldmin + 1
            ]
        );
        return back()->with('success', "Minimum stok untuk {$produk->name} ditambah 1.");
    }



    public function turunmin(Produk $produk)
    {
        if ($produk->minimum_stock > 0) {
            $oldmin = $produk->minimum_stock;
            $produk->decrement('minimum_stock', 1);

            activity_log(
                'Kurangi Minimum Stock',
                "Minimum Stock produk {$produk->name} diubah dari {$oldmin} menjadi " . ($oldmin - 1),
                'minimum_stock',
                [
                    'product_id' => $produk->id,
                    'old_min' => $oldmin,
                    'new_min' => $oldmin - 1
                ]
            );
        }
        return back()->with('success', "Minimum stok untuk {$produk->name} dikurangi 1.");
    }



    //ACT  LOG 

    public function aktivitaspengguna()
    {
        $log = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact('log'));
    }



    public function lapaktivitaspengguna(Request $request)
    {
        $log = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $query = ActivityLog::query();

        //filtre serc
        if (request()->filled('search')) {
            $search = $request->search;
            $query->where(function ($l) use ($search) {
                $l->where('action', 'like', "%{$search}%")
                    ->orWhere('module', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $log = $query->latest()->paginate(10);
        $log->appends($request->all());
        return view('admin.aktivitas.index', compact('log'));
    }

    public function showak($id)
    {
        $log = ActivityLog::with('user')->findorfail($id);
        return view('admin.aktivitas.show', compact('log'));
    }


    public function resetpw(User $user)
    {
        $user->update([
            'password' => Hash::make('123')
        ]);

        activity_log(
            'Reset Password',
            "Password Pengguna {$user->name} (ID: {$user->id}) direset",
            'Pengguna',
            ['user_id' => $user->id]
        );
        return back()->with('success', "Password {$user->name} berhasil direset ke '123'.");
    }
}
