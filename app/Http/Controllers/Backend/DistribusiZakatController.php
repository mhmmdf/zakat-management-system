<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\DistribusiZakat;
use App\Models\JumlahZakat;
use App\Models\Mustahik;
use Illuminate\Http\Request;

class DistribusiZakatController extends Controller
{
    public function index()
    {
        $items = DistribusiZakat::all();

        return view('pages.backend.distribusi_zakat.index', [
            'items' => $items
        ]);
    }

    public function create()
    {
        $items = Mustahik::all();

        return view('pages.backend.distribusi_zakat.create', compact('items'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $jumlahZakat = JumlahZakat::first();

            if ($jumlahZakat->jumlah_beras < $request->jumlah_beras) {
                return redirect()->back()->with('error', 'Stok beras tidak cukup untuk di distribusikan.');
            }

            if ($jumlahZakat->jumlah_uang < $request->jumlah_uang) {
                return redirect()->back()->with('error', 'Uang tidak cukup untuk di distribusikan.');
            }

            $pengumpulanZakat = new DistribusiZakat();
            $pengumpulanZakat->fill($request->all());
            $pengumpulanZakat->save();

            $jumlahZakat->jumlah_beras -= $request->jumlah_beras;
            $jumlahZakat->jumlah_uang -= $request->jumlah_uang;
            $jumlahZakat->total_distribusi += 1;
            $jumlahZakat->save();

            DB::commit();

            return redirect()->route('distribusi_zakat.index')->with('success', 'Pengumpulan zakat berhasil ditambahkan dan jumlah zakat berhasil diupdate.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Gagal melakukan distribusi zakat. Silakan coba lagi.');
        }
    }

    public function show($id) {}

    public function edit($id)
    {
        $item = DistribusiZakat::findOrFail($id);

        return view('pages.backend.distribusi_zakat.edit', [
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = DistribusiZakat::findOrFail($id);

        $previousBayarBeras = $item->jumlah_beras;
        $previousBayarUang = $item->jumlah_uang;

        $item->update($data);

        $jumlahZakat = JumlahZakat::first();

        if ($data['jumlah_beras'] < $previousBayarBeras) {
            $jumlahZakat->jumlah_beras += ($previousBayarBeras - $data['jumlah_beras']);
        } else {
            $jumlahZakat->jumlah_beras -= ($data['jumlah_beras'] - $previousBayarBeras);
        }

        if ($data['jumlah_uang'] < $previousBayarUang) {
            $jumlahZakat->jumlah_uang += ($previousBayarUang - $data['jumlah_uang']);
        } else {
            $jumlahZakat->jumlah_uang -= ($data['jumlah_uang'] - $previousBayarUang);
        }

        $jumlahZakat->save();

        return redirect()->route('distribusi_zakat.index')->with('success', 'Data distribusi zakat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $item = DistribusiZakat::findOrFail($id);

        $jumlahZakat = JumlahZakat::first();

        $jumlahZakat->jumlah_beras += $item->jumlah_beras;
        $jumlahZakat->jumlah_uang += $item->jumlah_uang;
        $jumlahZakat->total_distribusi -= 1;

        $jumlahZakat->save();

        $item->delete();

        return redirect()->route('distribusi_zakat.index')->with('success', 'Data distribusi zakat berhasil dihapus dan jumlah zakat diperbarui.');
    }
}
