<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use Illuminate\Http\Request;

class BayarController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $bayar = Bayar::search($query)->paginate(5);
        return view('bayar.index', compact('bayar', 'query'));
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

    public function edit( $id)
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
        $bayar->delete();

        return redirect()->route('bayar.index')
                        ->with('danger', 'Jenis pembayaran berhasil dihapus');
    }
}
