<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\JumlahZakat;
use App\Models\Muzakki;
use Illuminate\Http\Request;
use App\Models\PengumpulanZakat;

class PengumpulanZakatController extends Controller
{
    public function index()
    {
        $items = PengumpulanZakat::all();

        return view('pages.backend.pengumpulan_zakat.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $items = Muzakki::all();

        return view('pages.backend.pengumpulan_zakat.create', compact('items'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $pengumpulanZakat = new PengumpulanZakat();
            $pengumpulanZakat->fill($request->all());
            $pengumpulanZakat->save();

            $jumlahZakat = JumlahZakat::first();
            $jumlahZakat->jumlah_beras += $request->bayar_beras;
            $jumlahZakat->jumlah_uang += $request->bayar_uang;

            $jumlahZakat->total_beras += $request->bayar_beras;
            $jumlahZakat->total_uang += $request->bayar_uang;
            $jumlahZakat->total_distribusi += 1;

            $jumlahZakat->save();

            DB::commit();

            return redirect()->route('pengumpulan_zakat.index')->with('success', 'Pengumpulan zakat berhasil ditambahkan dan jumlah zakat berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal menambahkan pengumpulan zakat dan mengupdate jumlah zakat. Silakan coba lagi.');
        }
    }

    public function show($id) {}

    public function edit($id)
    {
        $item = PengumpulanZakat::findOrFail($id);

        return view('pages.backend.pengumpulan_zakat.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $item = PengumpulanZakat::findOrFail($id);

        $previousBayarBeras = $item->bayar_beras;
        $previousBayarUang = $item->bayar_uang;

        $data = $request->all();
        $item->update($data);

        DB::beginTransaction();

        try {
            $jumlahZakat = JumlahZakat::first();

            if ($request->bayar_beras < $previousBayarBeras) {
                $jumlahZakat->jumlah_beras -= ($previousBayarBeras - $request->bayar_beras);
                $jumlahZakat->total_beras -= ($previousBayarBeras - $request->bayar_beras);
            } else {
                $jumlahZakat->jumlah_beras += ($request->bayar_beras - $previousBayarBeras);
                $jumlahZakat->total_beras += ($request->bayar_beras - $previousBayarBeras);
            }

            if ($request->bayar_uang < $previousBayarUang) {
                $jumlahZakat->jumlah_uang -= ($previousBayarUang - $request->bayar_uang);
                $jumlahZakat->total_uang -= ($previousBayarUang - $request->bayar_uang);
            } else {
                $jumlahZakat->jumlah_uang += ($request->bayar_uang - $previousBayarUang);
                $jumlahZakat->total_uang += ($request->bayar_uang - $previousBayarUang);
            }

            $jumlahZakat->save();

            DB::commit();

            return redirect()->route('pengumpulan_zakat.index')->with('success', 'Pengumpulan zakat berhasil diperbarui dan jumlah zakat berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal memperbarui pengumpulan zakat dan mengupdate jumlah zakat. Silakan coba lagi.');
        }
    }

    public function destroy($id)
    {
        $item = PengumpulanZakat::findOrFail($id);

        DB::beginTransaction();

        try {
            $jumlahZakat = JumlahZakat::first();

            $jumlahZakat->jumlah_beras -= $item->bayar_beras;
            $jumlahZakat->jumlah_uang -= $item->bayar_uang;

            $jumlahZakat->total_beras -= $item->bayar_beras;
            $jumlahZakat->total_uang -= $item->bayar_uang;
            $jumlahZakat->total_distribusi -= 1;

            $jumlahZakat->save();

            $item->delete();

            DB::commit();

            return redirect()->route('pengumpulan_zakat.index')->with('success', 'Pengumpulan zakat berhasil dihapus dan jumlah zakat berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal menghapus pengumpulan zakat dan mengupdate jumlah zakat. Silakan coba lagi.');
        }
    }
}
