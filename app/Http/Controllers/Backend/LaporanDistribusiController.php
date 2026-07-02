<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DistribusiZakat;

class LaporanDistribusiController extends Controller
{
    public function index()
    {
        $jumlahZakat = DB::table('jumlah_zakat')->first();
        $totalBeras = $jumlahZakat->jumlah_beras;
        $totalUang = $jumlahZakat->jumlah_uang;
        $totalDistribusi = $jumlahZakat->total_distribusi;

        $items = DistribusiZakat::all();

        $distribusiBeras = $items->sum('jumlah_beras');
        $distribusiUang = $items->sum('jumlah_uang');

        return view('pages.backend.laporan_distribusi.index', [
            'items' => $items,
            'totalBeras' => $totalBeras,
            'totalUang' => $totalUang,
            'totalDistribusi' => $totalDistribusi,
            'distribusiBeras' => $distribusiBeras,
            'distribusiUang' => $distribusiUang
        ]);
    }
}
