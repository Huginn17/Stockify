<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;

if (! function_exists('activity_log')) {
    /**
     * Simpan log aktivitas pengguna
     *
     * @param string $action      Nama aksi, contoh: "Tambah Produk"
     * @param string|null $description  Penjelasan detail
     * @param string|null $module       Nama modul (produk, opname, dsb)
     * @param array $meta               Data tambahan
     */
    function activity_log(string $action, ?string $description = null, ?string $module = null, array $meta = [])
    {
       try {
           ActivityLog::create([
               'user_id' => auth()->id(),
               'action' => $action,
               'description' => $description,
               'module' => $module,
               'meta' => $meta,
               'ip' => request()->ip(),
           ]);
       } catch (\Throwable $e) {
        Log::error('Gagal mencatat activity_log: ' . $e->getMessage());
       }
    }
}