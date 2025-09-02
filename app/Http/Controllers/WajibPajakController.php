<?php

namespace App\Http\Controllers;

use App\Models\WajibPajak;
use Illuminate\Http\Request;
class WajibPajakController extends Controller
{
    // Tampilkan semua data
    public function index()
    {
        $wajibPajaks = WajibPajak::all();
        return view('admin.wajib_pajak.index', compact('wajibPajaks'));
    }

    // Tampilkan form tambah data
    public function create()
    {
        return view('admin.wajib_pajak.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:wajib_pajaks',
            'npwp' => 'nullable',
            'nama' => 'required',
            'alamat' => 'nullable',
            'telp' => 'nullable',
            'kelurahan' => 'nullable',
            'kecamatan' => 'nullable',
            'kota' => 'nullable',
            'tgl_daf' => 'nullable|date',
        ]);

        WajibPajak::create($request->all());

        return redirect()->route('wajib-pajak.index')->with('success', 'Data berhasil ditambahkan');
    }

    // // Tampilkan form edit data
    // public function edit($id)
    // {
        
    //     return view('admin.wajib_pajak.edit', compact('wajibPajak'));
    // }

    // // Simpan hasil edit
    // public function update(Request $request, $id)
    // {
    //     $wajibPajak = WajibPajak::findOrFail($id);

    //     $request->validate([
    //         'nik' => 'required|unique:wajib_pajaks,nik,' . $wajibPajak->id,
    //         'npwp' => 'nullable',
    //         'nama' => 'required',
    //         'alamat' => 'nullable',
    //         'telp' => 'nullable',
    //         'kelurahan' => 'nullable',
    //         'kecamatan' => 'nullable',
    //         'kota' => 'nullable',
    //         'tgl_daf' => 'nullable|date',
    //     ]);

    //     $wajibPajak->update($request->all());

    //     return redirect()->route('wajib-pajak.index')->with('success', 'Data berhasil diperbarui');
    // }

    // Hapus data
    public function destroy($id)
    {
        $wajibPajak = WajibPajak::findOrFail($id);
        $wajibPajak->delete();

        return redirect()->route('wajib-pajak.index')->with('success', 'Data berhasil dihapus');
    }
}
