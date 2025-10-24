<?php

namespace App\Http\Controllers;

use App\Models\Masterclient;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class MasterteknisiController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masterteknisi = Masterteknisi::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterteknisi = Masterteknisi::paginate(10);
        }
        return view('masterteknisi.index',[
            'masterteknisi' => $masterteknisi
        ]);
    }


    public function create()
    {
        return view('masterteknisi.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $data['idteknisi'] = $this->generateidteknisi();

        Masterteknisi::create($data);

        return redirect()->route('masterteknisi.index')->with('success', 'Data Telah ditambahkan');
    }

    public function generateidteknisi()
    {
        $latestSurat = Masterclient::orderBy('created_at', 'desc')->first();

        if (!$latestSurat) {
            return 'TK-001';
        }

        $lastKode = $latestSurat->idteknisi;
        $lastNumber = (int) substr($lastKode, -3);
        $newNumber = $lastNumber + 1;

        $newKode = 'TK-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }


    public function show($id)
    {

    }


    public function edit(Masterteknisi $masterteknisi)
    {
        return view('masterteknisi.edit', [
            'item' => $masterteknisi
        ]);
    }


    public function update(Request $request, Masterteknisi $masterteknisi)
    {
        $data = $request->all();

        $masterteknisi->update($data);

        //dd($data);

        return redirect()->route('masterteknisi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masterteknisi $masterteknisi)
    {
        $masterteknisi->delete();
        return redirect()->route('masterteknisi.index')->with('success', 'Data Telah dihapus');
    }
}
