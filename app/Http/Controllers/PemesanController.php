<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemesanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
    $pemesan = Pemesan::when($search, function($query, $search) {
        return $query->where('nama_pemesan', 'like', '%' . $search . '%')
                    ->orWhere('alamat', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
    })
    ->orderBy('created_at', 'desc')  // Urutkan berdasarkan waktu penambahan
    ->paginate(4);
    
    return view('pemesan.index', compact('pemesan', 'search'));
    }

    public function create()
    {
        return view('pemesan.index');
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'nama_pemesan' => 'required|unique:pemesans,nama_pemesan|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|unique:pemesans,no_hp',
            'image' => 'required|mimes:jpeg,jpg,png,svg|max:2048'
        ], [
            'nama_pemesan.required' => 'Nama pemesan harus di isi',
            'nama_pemesan.unique' => 'Nama sudah terdaftar',
            'nama_pemesan.max' => 'Maximal karakter adalah 255',
            'alamat.required' => 'Alamat harus di isi',
            'alamat.max' => 'Maximal karakter adalah 255',
            'no_hp.required' => 'No hp harus di isi',
            'no_hp.unique' => 'No hp sudah terdaftar',
            'no_hp.max' => 'Maximal karakter adalah 20',
            'image.required' => 'Foto pemesan harus ada',
            'image.mimes' => 'Format image harus sesuai',
            'image.max' => 'Ukuran gambar maksimal 2MB',

        ]);

        // Mengambil semua input kecuali file gambar
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Simpan image di folder 'public/images'
            $data['image'] = $imageName; // Simpan nama file image ke array data
        }

        // Simpan data ke database
        Pemesan::create([
            'nama_pemesan' => $validateData['nama_pemesan'],
            'alamat' => $validateData['alamat'],
            'no_hp' => $validateData['no_hp'],
            'image' => $data['image'] ?? null // Set null jika tidak ada gambar
        ]);



        return redirect()->route('pemesans.index')->with('success', 'Pemesan berhasil dibuat');
    }

    public function edit($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        return view('pemesan.edit', compact('pemesan'));
    }

    public function show($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        return view('pemesan.show', compact('pemesan'));
    }

    public function update(Request $request, Pemesan $pemesan)
    {
        $validateData = $request->validate([
            'nama_pemesan' => 'required|max:255',
            'alamat' => 'required|max:255',
            'no_hp' => 'required|unique:pemesans,no_hp,' . $pemesan->id,
            'image' => 'nullable|mimes:jpeg,jpg,png,svg|max:2048'
        ], [
            'nama_pemesan.required' => 'Nama pemesan harus di isi',
            'nama_pemesan.max' => 'Maximal karakter adalah 255',
            'alamat.required' => 'Alamat harus di isi',
            'alamat.max' => 'Maximal karakter adalah 255',
            'no_hp.required' => 'No hp harus di isi',
            'no_hp.unique' => 'No hp sudah terdaftar',
            'image.mimes' => 'Format image harus sesuai',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            // Hapus image lama jika ada
            if ($pemesan->image) {
                Storage::delete('public/images/' . $pemesan->image);
            }

            // Simpan image baru
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName); // Simpan image di folder 'public/images'
            $data['image'] = $imageName; // Simpan nama file image ke array data
        } else {
            // Pertahankan image lama jika tidak ada image baru
            $data['image'] = $pemesan->image;
        }

        $pemesan->update($data);

        return redirect()->route('pemesans.index')->with('success', 'Data pemesan berhasil di edit');
    }


    public function destroy($id)
    {
        $pemesan = Pemesan::findOrFail($id);

        // Cek apakah pemesan memiliki pesanan yang sedang aktif
        if ($pemesan->pesanan()->exists()) {
            return redirect()->route('pemesans.index')->withErrors(['error' => 'Pemesan ini sedang menyewa mobil dan tidak bisa dihapus.']);
        }
        if ($pemesan->riwayat()->exists()) {
            return redirect()->route('pemesans.index')->withErrors(['error' => 'Pemesan ini memiliki data di history dan tidak bisa dihapus.']);
        }

        // Hapus gambar jika ada
        if ($pemesan->image) {
            Storage::delete('public/images/' . $pemesan->image);
        }

        // Hapus pemesan
        $pemesan->delete();

        return redirect()->route('pemesans.index')->with('danger', 'Data pemesan berhasil dihapus');
    }
    
}