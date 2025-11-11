<?php

namespace App\Http\Controllers;

use App\Models\Masterclient;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class MasterclientController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $masterclient = Masterclient::where('nama', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $masterclient = Masterclient::paginate(10);
        }
        return view('masterclient.index', [
            'masterclient' => $masterclient,
        ]);
    }

    public function create()
    {
        return view('masterclient.create');
    }

    public function store(Request $request)
{
    $data = $request->all();

    $data['kodeclient'] = $this->generatekodeclient();

    Masterclient::create($data);

    // Redirect kembali ke index dengan pesan sukses
    return redirect()->route('masterclient.index')->with('success', 'Data Telah ditambahkan');
}


    public function generatekodeclient()
    {
        $latestSurat = Masterclient::orderBy('created_at', 'desc')->first();

        if (!$latestSurat) {
            return 'CL-001';
        }

        $lastKode = $latestSurat->kodeclient;
        $lastNumber = (int) substr($lastKode, -3);
        $newNumber = $lastNumber + 1;

        $newKode = 'CL-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function show($id) {}

    public function edit(Masterclient $masterclient)
    {
        return view('masterclient.edit', [
            'item' => $masterclient,
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
