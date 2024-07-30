<?php

namespace App\Http\Controllers;

use App\Models\Merk;
use Illuminate\Http\Request;

class MerksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $merks = Merk::all();
        return view('merks.index', ['merks' => $merks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'merk' => 'required|unique:merks,nama_merk|max:100'
        ], [
            'merk.required' => 'merk harus di isi',
            'merk.unique' => 'merk sudah terdaftar',
            'merk.max' => 'Teks Kategori maximal adalah 100'
        ]);

        Merk::create([
            'nama_merk' => $validateData['merk']
        ]);
        return redirect('merks')->with('success', 'Merk berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Merk $merk)
    {

        return view('merks.edit', compact('merk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Merk $merk)
    {
        if ($merk->nama_merk === $request->input('merk')) {
            return redirect('merks')->with('success', 'Merk Berhasil Diubah');
        }

        $validateData = $request->validate([
            'merk' => 'required|unique:merks,nama_merk|max:100'
        ], [
            'merk.required' => 'merk harus di isi',
            'merk.unique' => 'merk sudah terdaftar',
            'merk.max' => 'Texs Kategori maximal adalah 100'
        ]);

        $merk->update(['nama_merk' => $validateData['merk']]);
        return redirect('merks')->with('success', 'Merk Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Merk $merk)
    {
        $merk->delete();
        return redirect()->route('merks.index')->with('success', 'Merk berhasil dihapus');
    }
}
