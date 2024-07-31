<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MobilsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mobil = Mobil::all();
        $merk = Merk::all();
        return view('mobils.index', ['mobil' => $mobil], compact('merk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'mobil' => 'required|unique:mobils,nama_m|max:255',
            'merk' => 'required',
            'kursi' => 'required|max:5',
            'npolisi' => 'required|unique:mobils,nomor_polisi|max:100',
            'tahun' => 'required|min:4',
            'harga_per_hari' => 'required|max:150|min:6',
            'gambar' => 'required|mimes:jpeg,jpg,png,svg|max:2048'
        ], [
            'mobil.required' => 'Nama mobil harus di isi',
            'mobil.unique' => 'Mobil sudah terdaftar',
            'mobil.max'  => 'Maximal karakter adalah 255',
            'merk.required' => 'Merk mobil harus di isi',
            'kursi.required' => 'Kursi mobil harus di isi',
            'kursi.max' => 'Maximal anggka adalah 5',
            'npolisi.required'  => 'Nomor polisi harus di isi',
            'npolisi.unique' => 'Nomor polisi sudah terdaftar',
            'tahun.required' => 'Tahun mobil harus di isi',
            'tahun.min' => 'Minimal jumlah angka adalah 4',
            'harga_per_hari.required' => 'Harga per hari harus di isi',
            'harga_per_hari.min' => 'Minimal jumlah angka adalah 6',
            'gambar.required' => 'Gambar mobil harus ada',
            'gambar.mimes' => 'Format gambar harus sesuai',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Mengambil semua input kecuali file gambar
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Simpan gambar di folder 'public/images'
            $data['gambar'] = $imageName; // Simpan nama file gambar ke array data
        }

        // Simpan data ke database
        Mobil::create([
            'nama_m' => $validateData['mobil'],
            'merk_id' => $validateData['merk'],
            'kursi' => $validateData['kursi'],
            'nomor_polisi' => $validateData['npolisi'],
            'tahun' => $validateData['tahun'],
            'harga_per_hari' => $validateData['harga_per_hari'],
            'gambar' => $data['gambar'] ?? null // Set null jika tidak ada gambar
        ]);

        return redirect('mobils')->with('success', 'Mobil berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mobil $mobil)
    {
        return view('mobils.show', compact('mobil'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mobil $mobil)
    {
        $merk = Merk::all();
        return view('mobils.edit', compact('mobil', 'merk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mobil $mobil)
    {
        // Validasi input, gambar tidak diwajibkan
        $validateData = $request->validate([
            'mobil' => 'required|unique:mobils,nama_m,' . $mobil->id . '|max:255',
            'merk' => 'required',
            'kursi' => 'required|max:5',
            'npolisi' => 'required|unique:mobils,nomor_polisi,' . $mobil->id . '|max:100',
            'tahun' => 'required|min:4',
            'harga_per_hari' => 'required|max:150|min:6',
            'gambar' => 'nullable|mimes:jpeg,jpg,png,svg|max:2048'
        ], [
            'mobil.required' => 'Nama mobil harus di isi',
            'mobil.unique' => 'Mobil sudah terdaftar',
            'mobil.max'  => 'Maximal karakter adalah 255',
            'merk.required' => 'Merk mobil harus di isi',
            'kursi.required' => 'Kursi mobil harus di isi',
            'kursi.max' => 'Maximal anggka adalah 5',
            'npolisi.required'  => 'Nomor polisi harus di isi',
            'npolisi.unique' => 'Nomor polisi sudah terdaftar',
            'tahun.required' => 'Tahun mobil harus di isi',
            'tahun.min' => 'Minimal jumlah angka adalah 4',
            'harga_per_hari.required' => 'Harga per hari harus di isi',
            'harga_per_hari.min' => 'Minimal jumlah angka adalah 6',
            'gambar.mimes' => 'Format gambar harus sesuai',
            'gambar.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        // Ambil semua input kecuali gambar
        $data = $request->except('gambar');

        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($mobil->gambar) {
                Storage::delete('public/images/' . $mobil->gambar);
            }

            // Simpan gambar baru
            $image = $request->file('gambar');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Simpan gambar di folder 'public/images'
            $data['gambar'] = $imageName; // Simpan nama file gambar ke array data
        } else {
            // Pertahankan gambar lama jika tidak ada gambar baru
            $data['gambar'] = $mobil->gambar;
        }

        // Perbarui data mobil
        $mobil->update([
            'nama_m' => $validateData['mobil'],
            'merk_id' => $validateData['merk'],
            'kursi' => $validateData['kursi'],
            'nomor_polisi' => $validateData['npolisi'],
            'tahun' => $validateData['tahun'],
            'harga_per_hari' => $validateData['harga_per_hari'],
            'gambar' => $data['gambar'] // Set gambar baru atau lama
        ]);

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mobil $mobil)
    {

        // Jika ada gambar, hapus gambar dari storage
        if ($mobil->gambar) {
            Storage::delete('public/images/' . $mobil->gambar);
        }

        // Hapus data mobil dari database
        $mobil->delete();

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil dihapus');
    }
}