<?php

namespace App\Http\Controllers;

use App\Models\Masterclient;
use Illuminate\Http\Request;

class MasterclientController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $Masterclient = Masterclient::where('nama', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $masterclient = Masterclient::paginate(10);
        }
        return view('masterclient.index',[
            'masterclient' => $masterclient
        ]);
    }


    public function create()
    {
        return view('masterclient.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masterclient::create($data);

        return redirect()->route('masterclient.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Masterclient $masterclient)
    {
        return view('masterclient.edit', [
            'item' => $masterclient
        ]);
    }


    public function update(Request $request, Masterclient $masterclient)
    {
        $data = $request->all();

        $masterclient->update($data);

        //dd($data);

        return redirect()->route('masterclient.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Masterclient $masterclient)
    {
        $masterclient->delete();
        return redirect()->route('masterclient.index')->with('success', 'Data Telah dihapus');
    }
}
