<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Produk;
use App\Models\StockTransaction;
use App\Models\Suppliers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManajerController extends Controller
{
    public function index()
    {
        $produkHampirHabis = Produk::all()->filter(function ($produk) {
            return $produk->current_stock < $produk->minimum_stock;
        });

        $hariini =Carbon::today('Asia/Jakarta');

        //masuk hari ini
        $barangmasukhariini = StockTransaction::whereDate('date', $hariini)
        ->where('type', 'masuk')
        ->where('status', 'Diterima')
        ->sum('quantity');

        //keluar hari ini
        $barangkeluarhariini = StockTransaction::whereDate('date', $hariini)
        ->where('type', 'keluar')
        ->where('status', 'Dikeluarkan')
        ->sum('quantity');

        return view('manajer.dashboard', compact('produkHampirHabis', 'barangmasukhariini', 'barangkeluarhariini'));
    }

    public function supplier()
    {
        $query = Suppliers::query();

        //filter seac
        if(request()->filled('search')) {
            $search = request()->search ;
            $query->where(function ($s) use ($search) {
                $s->where('name', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

           //sorting 
        if(request()->filled('sort')) {
            if(request()->sort == 'name_asc') {
                 $query->orderBy('name', 'asc')->get();
            } elseif(request()->sort == 'name_desc') {
                 $query->orderBy('name', 'desc')->get();
            }
        }
        
        //ambil hasil penc
        $supplier = $query->get();
       


        return view('manajer.supplier.index', compact('supplier'));
    }

    public function produk(Request $request)
    {
        $query = Produk::query();

        //filter seac
        if(request()->filled('search')) {
            $search = $request->search ;
            $query->where(function ($p) use ($search) {
                $p->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->orWhereHas('kategori', function ($k) use ($search) 
                    {$k->where('name', 'like', "%{$search}%");
                    });
            });
        }

         //sorting 
        if(request()->filled('sort')) {
            if(request()->sort == 'name_asc') {
                 $query->orderBy('name', 'asc')->get();
            } elseif(request()->sort == 'name_desc') {
                 $query->orderBy('name', 'desc')->get();
            }
        }


        //ambil hasil penc
        $produk = $query->get();
        return view('manajer.produk.index', compact('produk'));
    }

    public function show_produk(Produk $produk)
    {
        return view('manajer.produk.show', compact('produk'));
    }


    public function stock()
    {
        $produk = Produk::all();
        
        return view('manajer.stock.index', compact('produk'));
    }

    public function notifikasi()
    {
        $produkHampirHabis = Produk::all()->filter(function ($produk) {
            return $produk->current_stock < $produk->minimum_stock;
        });

        return view('manajer.stock.index', compact('produkHampirHabis'));
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
        return view('manajer.laporan.masuk.index', compact('transaksi'));
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
        return view('manajer.laporan.keluar.index', compact('transaksi'));
    }


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
        $transaksiterima = StockTransaction::whereIn('status',['Diterima','Dikeluarkan'])->get();


        $kategorilist = Categories::all();

        return view('manajer.laporan.stok-barang', compact(
            'bulanlist',
            'transaksiterima',
            'kategorilist',

        ));
    }
}
