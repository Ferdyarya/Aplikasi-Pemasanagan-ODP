<?php

namespace App\Http\Controllers;

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

        Masterteknisi::create($data);

        return redirect()->route('masterteknisi.index')->with('success', 'Data Telah ditambahkan');
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
