<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $bayar = Bayar::when($search, function($query, $search) {
            return $query->where('jenis_bayar', 'like', '%' . $search . '%');
        })
        ->orderBy('created_at', 'desc')  // Urutkan berdasarkan waktu penambahan
        ->paginate(4);
        
        return view('bayar.index', compact('bayar', 'search'));
    }

    public function create()
    {
        $bayar = Bayar::all();
        return view('bayar.index', compact('bayar'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_bayar' => 'required'
        ]);

        Bayar::create($request->all());

        return redirect()->route('bayar.index')->with('success', 'Jenis pembayaran berhasil dibuat.');
    }

    public function edit($id)
    {
        $bayar = Bayar::findOrFail($id);
        return view('bayar.edit', compact('bayar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis_bayar' => 'required'
        ]);

        $bayar = Bayar::findOrFail($id);
        $bayar->update($request->all());

        return redirect()->route('bayar.index')->with('success', 'Jenis pembayaran berhasil di edit');
    }

    public function destroy($id)
    {
        $bayar = Bayar::findOrFail($id);


        if ($bayar->pesanan()->exists()) {
            return redirect()->back()->withErrors(['error' => 'Data ini sedang digunakan dan tidak bisa dihapus.']);
        }

        $bayar->delete();

        return redirect()->route('bayar.index')
            ->with('danger', 'Jenis pembayaran berhasil dihapus');
    }
}