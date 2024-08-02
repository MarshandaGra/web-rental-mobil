<?php

namespace App\Http\Controllers;

use App\Models\Bayar;
use App\Models\Mobil;
use App\Models\Pemesan;
use App\Models\Pengembalian;
use App\Models\Pesanan;
use App\Models\Riwayat;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\New_;

class PesanannController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemesan = Pemesan::all();
        $mobil = Mobil::all();
        $bayar = Bayar::all();
        $pesanan = Pesanan::with('pemesan', 'mobil', 'bayar')->get();
        return view('pesanan.index', compact('pesanan', 'pemesan', 'mobil', 'bayar'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Pesanan $pesanan)
    {
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

        $mobilId = $validateData['mobil'];
        $tanggalMulai = new Carbon($validateData['tanggal_mulai']);
        $tanggalKembali = new Carbon($validateData['tanggal_kembali']);

        // Validasi apakah mobil sudah dipinjam dalam rentang tanggal yang sama
        $conflict = Pesanan::where('mobil_id', $mobilId)
            ->where(function ($query) use ($tanggalMulai, $tanggalKembali) {
                $query->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalKembali])
                    ->orWhereBetween('tanggal_kembali', [$tanggalMulai, $tanggalKembali])
                    ->orWhere(function ($query) use ($tanggalMulai, $tanggalKembali) {
                        $query->where('tanggal_mulai', '<=', $tanggalMulai)
                            ->where('tanggal_kembali', '>=', $tanggalKembali);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'mobil' => 'Mobil ini sudah dipinjam pada tanggal yang dipilih.'
            ])->withInput();
        }

        $jumlahHari = $tanggalKembali->diffInDays($tanggalMulai) + 1;
        $mobil = Mobil::find($mobilId);
        $hargaTotal = $mobil->harga_per_hari * $jumlahHari;

        Pesanan::create([
            'pemesan_id' => $validateData['pemesan'],
            'mobil_id' => $validateData['mobil'],
            'bayar_id' => $validateData['bayar'],
            'tanggal_mulai' => $validateData['tanggal_mulai'],
            'tanggal_kembali' => $validateData['tanggal_kembali'],
            'harga_total' => $hargaTotal,
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

        $mobilId = $validateData['mobil'];
        $tanggalMulai = new Carbon($validateData['tanggal_mulai']);
        $tanggalKembali = new Carbon($validateData['tanggal_kembali']);

        // Validasi apakah mobil sudah dipinjam dalam rentang tanggal yang sama, kecuali untuk pesanan yang sedang diedit
        $conflict = Pesanan::where('mobil_id', $mobilId)
            ->where('id', '<>', $pesanan->id)
            ->where(function ($query) use ($tanggalMulai, $tanggalKembali) {
                $query->whereBetween('tanggal_mulai', [$tanggalMulai, $tanggalKembali])
                    ->orWhereBetween('tanggal_kembali', [$tanggalMulai, $tanggalKembali])
                    ->orWhere(function ($query) use ($tanggalMulai, $tanggalKembali) {
                        $query->where('tanggal_mulai', '<=', $tanggalMulai)
                            ->where('tanggal_kembali', '>=', $tanggalKembali);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()->withErrors([
                'tanggal_kembali' => 'Mobil ini sudah dipinjam pada tanggal yang dipilih.'
            ])->withInput();
        }

        $jumlahHari = $tanggalKembali->diffInDays($tanggalMulai) + 1;
        $mobil = Mobil::find($mobilId);
        $hargaTotal = $mobil->harga_per_hari * $jumlahHari;

        $pesanan->update([
            'pemesan_id' => $validateData['pemesan'],
            'mobil_id' => $validateData['mobil'],
            'bayar_id' => $validateData['bayar'],
            'tanggal_mulai' => $validateData['tanggal_mulai'],
            'tanggal_kembali' => $validateData['tanggal_kembali'],
            'harga_total' => $hargaTotal,
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

    public function kembali(Request $request, $id)
    {
        $pesanan = Pesanan::findOrFail($id);

        // Validasi denda
        $validateData = $request->validate([
            'denda' => 'required|numeric|min:0',
        ], [
            'denda.required' => 'Denda harus diisi',
            'denda.numeric' => 'Denda harus berupa angka',
            'denda.min' => 'Denda tidak boleh negatif',
        ]);

        $denda = $validateData['denda'];

        // Hitung harga total dengan denda
        $hargaTotal = $pesanan->harga_total + $denda;

        // Buat entri riwayat
        Riwayat::create([
            'pemesan_id' => $pesanan->pemesan_id,
            'mobil_id' => $pesanan->mobil_id,
            'tanggal_mulai' => $pesanan->tanggal_mulai,
            'tanggal_kembali' => now(),
            'harga_total' => $hargaTotal,
        ]);

        // Hapus data pesanan
        $pesanan->delete();

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dikembalikan dan denda telah ditambahkan');
    }

    public function formDenda($id)
    {
        $pesanan = Pesanan::findOrFail($id);
        return view('pesanan.kembali', compact('pesanan'));
    }

    public function riwayat()
    {
        // Ambil data riwayat dengan relasi mobil dan customer
        $riwayat = Riwayat::with(['pemesan', 'mobil'])->get();

        return view('pesanan.riwayat', compact('riwayat'));
    }
}
