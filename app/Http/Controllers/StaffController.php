<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\StockTransaction;
use Illuminate\Http\Request;

use function PHPSTORM_META\type;

class StaffController extends Controller
{
    public function index()
    {
        $barangmasuk = StockTransaction::where('type', 'masuk')
            ->where('status', 'pending')->with('produk')->get();

        $barangkeluar = StockTransaction::where('type', 'keluar')
            ->where('status', 'pending')->with('produk')->get();

        //hitung badge
        $jumlahMasuk = $barangmasuk->count();
        $jumlahKeluar = $barangkeluar->count();

        $produk = Produk::all()->map(function ($produk) {
            $produk->stock_sistem = $produk->current_stock;
            $produk->stock_fisik = $produk->current_stock;

            $produk->selisih = 0;
            return $produk;
        });
        return view('staff.dashboard', compact('barangmasuk', 'barangkeluar', 'produk', 'jumlahMasuk', 'jumlahKeluar'));
    }



    public function konfirmasi()
    {
        $transaksi = StockTransaction::where('status', 'pending')->get();
        return view('staff.konfirmasi.index', compact('transaksi'));
    }

    public function updateKonfirmasi(Request $request, StockTransaction $transaksi)
    {
        $request->validate([
            'status' => 'required|in:Diterima,Ditolak,Dikeluarkan'
        ]);

        $produk = $transaksi->produk;

        // cek stok cukup jika keluar
        if ($request->status === 'Dikeluarkan' && $produk->current_stock < $transaksi->quantity) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        // jika menolak transaksi
        if ($request->status === 'Ditolak') {
            $transaksi->status = 'Ditolak';
            $transaksi->save();

            activity_log(
                "Tolak Transaksi",
                "Transaksi #{$transaksi->id} ditolak oleh Staff",
                'transaksi',
                [
                    'transaction_id' => $transaksi->id,
                    'status' => 'Ditolak'
                ]
            );

            return back()->with('success', 'Transaksi berhasil ditolak');
        }

        // Kalau konfirmasi (masuk/keluar)
        $transaksi->status = $request->status;
        $transaksi->save();

        activity_log(
            "Konfirmasi Transaksi",
            "Transaksi #{$transaksi->id} diubah menjadi {$transaksi->status}",
            'Konfirmasi',
            [
                'transaction_id' => $transaksi->id,
                'type' => $transaksi->type,
                'status' => $transaksi->status,
            ]
        );

        return back()->with('success', 'Status Transaksi Berhasil Diubah');
    }




    //OPNAME
    //tampilkan hal
    public function index3(Request $request)
    {
        $barangmasuk = StockTransaction::where('type', 'masuk')
            ->where('status', 'pending')->with('produk')->get();

        $barangkeluar = StockTransaction::where('type', 'keluar')
            ->where('status', 'pending')->with('produk')->get();

        $jumlahMasuk = $barangmasuk->count();
        $jumlahKeluar = $barangkeluar->count();

        $produk = Produk::all()->map(function ($produk) {
            $produk->stock_sistem = $produk->current_stock;
            $produk->stock_fisik = $produk->current_stock;
            $produk->selisih = 0;
            return $produk;
        });

    
        $query = StockTransaction::with('produk')->where('status', 'pending');

        // // filter search
        // if ($request->filled('search')) {
        //     $search = $request->search;
        //     $query->where(function ($q) use ($search) {
        //         $q->whereHas('produk', function ($p) use ($search) {
        //             $p->where('name', 'like', "%{$search}%");
        //         })->orWhere('notes', 'like', "%{$search}%");
        //     });
        // }

        // // filter type
        // if ($request->filled('type')) {
        //     $query->where('type', strtolower($request->type));
        // }

        $transaksi = $query->get(); 

       
        if (session('opname_data')) {
            foreach ($produk as $p) {
                if (isset(session('opname_data')[$p->id])) {
                    $p->stock_fisik = session('opname_data')[$p->id]['stock_fisik'];
                    $p->selisih = $p->stock_fisik - $p->stock_sistem;
                }
            }
        }

        return view('staff.dashboard', compact(
            'produk',
            'transaksi',
            'barangmasuk',
            'barangkeluar',
            'jumlahMasuk',
            'jumlahKeluar'
        ));
    }


    //simpan opnamenya
    public function store(Request $request)
    {
        $validated = $request->validate([
            'produk' => 'required|array',
            'produk.*.id' => 'required|exists:products,id',
            'produk.*.stock_fisik' => 'required|integer|min:0',
        ]);

        $opnamereference = 'OPNAME-' . now()->format('Y-m-d-H-i-s');
        $createdtransaksi = 0;

        foreach ($validated['produk'] as $pdata) {
            $produk = Produk::find($pdata['id']);
            $stock_sistem = $produk->current_stock;
            $stock_fisik = $pdata['stock_fisik'];
            $selisih = $stock_fisik - $stock_sistem;

            if ($selisih != 0) {
                StockTransaction::create([
                    'product_id' => $produk->id,
                    'user_id' => auth()->id(),
                    'type' => $selisih > 0 ? 'masuk' : 'keluar',
                    'quantity' => abs($selisih), //nilai absolut
                    'date' => now(),
                    // 'status' => 'Diterima',
                    'status' => $selisih > 0 ? 'Diterima' : 'Dikeluarkan',
                    'notes' => 'penyesuaian stock opname',
                    'is_opname' => 1,
                    'opname_reference' => $opnamereference
                ]);

                activity_log(
                    "Input Stock Opname",
                    "Opanme produk {$produk->name}: sistem {$stock_sistem} → fisik {$stock_fisik} selisih {$selisih}",
                    'opname',
                    [
                        'product_id' => $produk->id,
                        'stock_sistem' => $stock_sistem,
                        'stock_fisik' => $stock_fisik,
                        'selisih' => $selisih,
                        'opname_reference' => $opnamereference
                    ]
                );


                $createdtransaksi++;
            }
        }

        if ($createdtransaksi > 0) {
            return redirect()->route('staff.opname')->with('success', 'Opname Berhasil Disimpan');
        }

        return redirect()->route('staff.opname')->with('info', 'Opname Gagal Disimpan');
    }

    //riwayat
    public function show()
    {
        $opnametransaksi = StockTransaction::with(['produk', 'user'])
            ->where('is_opname', 1)
            ->select(['*', 'opname_reference as reference'])
            ->orderBy('date', 'desc')
            ->paginate(10);

        $produk = Produk::all()->map(function ($produk) {
            $produk->stock_sistem = $produk->current_stock;
            $produk->stock_fisik = $produk->current_stock;

            $produk->selisih = 0;
            return $produk;
        });
        return view('staff.show', compact('opnametransaksi', 'produk'));
    }

    public function hitung(Request $request)
    {
        $validated = $request->validate([
            'produk' => 'required|array',
            'produk.*.id' => 'required|exists:products,id',
            'produk.*.stock_fisik' => 'required|integer|min:0',
        ]);

        return redirect()->route('staff.opname')
            ->with('opname_data', $validated['produk']);
    }
}
