<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Mobil;
use App\Models\Pemesan;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesanannController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
        public function index(Request $request)
        {
            $search = $request->input('search');

            $pesanan = Pesanan::with('pemesan', 'mobil', 'bayar')
                ->when($search, function($query, $search) {
                    return $query->whereHas('pemesan', function($q) use ($search) {
                            $q->where('nama_pemesan', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('mobil', function($q) use ($search) {
                            $q->where('nama_m', 'like', '%' . $search . '%');
                        })
                        ->orWhereHas('bayar', function($q) use ($search) {
                            $q->where('jenis_bayar', 'like', '%' . $search . '%');
                        });
                })
                ->orderBy('created_at', 'desc')
                ->paginate(4);

                $pemesan = Pemesan::all();
                $mobil = Mobil::all();
                $bayar = Bayar::all();
                
                return view('pesanan.index', compact('pesanan', 'pemesan', 'mobil', 'bayar', 'search'));
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
            'pemesan' => 'required',
            'mobil' => 'required',
            'bayar' => 'required',
            'tanggal_mulai' => 'required|after_or_equal:today',
            'tanggal_kembali' => 'required|after_or_equal:tanggal_mulai',
        ], [
            'pemesan.required' => 'pemesan harus di isi',
            'mobil.required' => 'mobil harus di isi',
            'bayar.required' => 'bayar harus di isi',
            'tanggal_mulai.required' => 'tanggal_mulai harus di isi',
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai tidak bisa sebelum hari ini',
            'tanggal_kembali.required' => 'tanggal_kembali harus di isi',
            'tanggal_kembali.after_or_equal' => 'Tanggal selesai tidak bisa di bawah tanggal mulai',
        ]);

        Pesanan::create([
            'pemesan_id' => $validateData['pemesan'],
            'mobil_id' => $validateData['mobil'],
            'bayar_id' => $validateData['bayar'],
            'tanggal_mulai' => $validateData['tanggal_mulai'],
            'tanggal_kembali' => $validateData['tanggal_kembali'],
        ]);

        return redirect('pesanan')->with('success', 'Penyewa berhasil ditambah');
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
    public function edit(Pesanan $pesanan)
    {
        $pemesan = Pemesan::all();
        $mobil = Mobil::all();
        $bayar = Bayar::all();
        return view('pesanan.edit', compact('pesanan', 'pemesan', 'mobil', 'bayar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        $validateData = $request->validate([
            'pemesan' => 'required',
            'mobil' => 'required',
            'bayar' => 'required',
            'tanggal_mulai' => 'required|after_or_equal:today',
            'tanggal_kembali' => 'required|after_or_equal:tanggal_mulai',
        ], [
            'pemesan.required' => 'pemesan harus di isi',
            'mobil.required' => 'mobil harus di isi',
            'bayar.required' => 'bayar harus di isi',
            'tanggal_mulai.required' => 'tanggal_mulai harus di isi',
            'tanggal_mulai.after_or_equal' => 'Tanggal mulai tidak bisa sebelum hari ini',
            'tanggal_kembali.required' => 'tanggal_kembali harus di isi',
            'tanggal_kembali.after_or_equal' => 'Tanggal selesai tidak bisa di bawah tanggal mulai',
        ]);

        $pesanan->update([
            'pemesan_id' => $validateData['pemesan'],
            'mobil_id' => $validateData['mobil'],
            'bayar_id' => $validateData['bayar'],
            'tanggal_mulai' => $validateData['tanggal_mulai'],
            'tanggal_kembali' => $validateData['tanggal_kembali'],
        ]);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();
        return redirect()->route('pesanan.index')->with('success', 'Penyewa berhasil dihapus');
    }
}