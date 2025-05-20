<?php

namespace App\Http\Controllers;

use App\Models\Masteralat;
use Illuminate\Http\Request;

class MasteralatController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $masteralat = Masteralat::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masteralat = Masteralat::paginate(10);
        }
        return view('masteralat.index',[
            'masteralat' => $masteralat
        ]);
    }


    public function create()
    {
        return view('masteralat.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masteralat::create($data);

        return redirect()->route('masteralat.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Masteralat $masteralat)
    {
        return view('masteralat.edit', [
            'item' => $masteralat
        ]);
    }


    public function update(Request $request, Masteralat $masteralat)
    {
        $data = $request->all();

        $masteralat->update($data);

        //dd($data);

        return redirect()->route('masteralat.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masteralat $masteralat)
    {
        $masteralat->delete();
        return redirect()->route('masteralat.index')->with('success', 'Data Telah dihapus');
    }
}
