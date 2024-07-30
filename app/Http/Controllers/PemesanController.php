<?php

namespace App\Http\Controllers;

use App\Models\Pemesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemesanController extends Controller
{
    public function index()
    {
        $pemesan = Pemesan::all();
        return view('pemesan.index', compact('pemesan'));
    }

    public function create()
    {
        return view('pemesan.index');
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'nama_pemesan'=> 'required',
            'alamat'=>'required',
            'no_hp'=>'required',
            'image' => 'image|file|max:1024'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('pemesan-images');
        }

        Pemesan::create($validatedData);

        return redirect()->route('pemesan.index')->with('success','Pemesan berhasil dibuat');
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

    public function update(Request $request, $id)
    {
        $rules = [
            'nama_pemesan'=> 'required',
            'alamat'=>'required',
            'no_hp'=>'required',
            'image'=>'image|file|max:1024',
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('pemesan-images');
        }
        
        
        $pemesan = Pemesan::findOrFail($id);
        $pemesan->update($validatedData);

        return redirect()->route('pemesan.index')->with('success', 'Data pemesan berhasil di edit');
    }

    public function destroy($id)
    {
        $pemesan = Pemesan::findOrFail($id);
        if($pemesan->image){
            Storage::delete($pemesan->image);
        }
        $pemesan->delete();

        return redirect()->route('pemesan.index')->with('danger', 'Data pemesan berhasil dihapus');
    }
    
}
