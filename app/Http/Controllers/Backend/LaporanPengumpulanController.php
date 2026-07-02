<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\PengumpulanZakat;

class LaporanPengumpulanController extends Controller
{
    public function index()
    {
        $jumlahZakat = DB::table('jumlah_zakat')->first();
        $totalBeras = $jumlahZakat->total_beras;
        $totalUang = $jumlahZakat->total_uang;

        $items = PengumpulanZakat::all();

        return view('pages.backend.laporan_pengumpulan.index', [
            'items' => $items,
            'totalBeras' => $totalBeras,
            'totalUang' => $totalUang
        ]);
    }
}
