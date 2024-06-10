<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BarangMasuk;
use App\Models\Barang;
use App\Models\BarangKeluar; // pastikan model BarangKeluar sudah diimpor
use Illuminate\Foundation\Validation\ValidatesRequests;

class BarangMasukController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $barangmasuks = BarangMasuk::with('barang')->paginate(10);
        return view('barangmasuk.index', compact('barangmasuks'));
    }

    public function create()
    {
        $barangs = Barang::all();
        return view('barangmasuk.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        $barangmasuk = BarangMasuk::create($request->all());
        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        return view('barangmasuk.show', compact('barangmasuk'));
    }

    public function edit($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangs = Barang::all();
        return view('barangmasuk.edit', compact('barangmasuk', 'barangs'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tgl_masuk' => 'required|date',
            'qty_masuk' => 'required|integer|min:1',
            'barang_id' => 'required|exists:barang,id',
        ]);

        $barangmasuk = BarangMasuk::findOrFail($id);
        $barangmasuk->update($request->all());

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Diperbarui!']);
    }

    public function destroy($id)
    {
        $barangmasuk = BarangMasuk::findOrFail($id);

        // Periksa apakah ada catatan barangkeluar yang terkait dengan barangmasuk ini
        $barangKeluarCount = BarangKeluar::where('barang_id', $barangmasuk->barang_id)
        ->where('tgl_keluar', '>=', $barangmasuk->tgl_masuk)
        ->count();

        // Jika ada catatan barangkeluar terkait, kembalikan pesan kesalahan
        if ($barangKeluarCount > 0) {
        return redirect()->route('barangmasuk.index')->withErrors(['error' => 'Data Barang Masuk tidak dapat dihapus karena ada Barang Keluar yang terkait.']);
        }

        // Jika tidak ada catatan barangkeluar terkait, lanjutkan penghapusan
        $barangmasuk->delete();

        return redirect()->route('barangmasuk.index')->with(['success' => 'Data Barang Masuk Berhasil Dihapus!']);
    }
}
