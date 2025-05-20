<?php

namespace App\Http\Controllers;

use App\Models\Perbaikan;
use App\Models\Masteralat;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class PerbaikanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $perbaikan = Perbaikan::whereHas('masteralat', function($query) use ($request) {
                $query->where('nama', 'LIKE', '%' . $request->search . '%');
            })->paginate(10);
        } else {
            $perbaikan = Perbaikan::paginate(10);
        }

        return view('perbaikan.index', [
            'perbaikan' => $perbaikan
        ]);
    }


    public function create()
    {
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('perbaikan.create', [
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
        return view('perbaikan.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
    {
        $data = Perbaikan::create($request->all());
        if($request->hasFile('fotosebelum')) {
            $request->file('fotosebelum')->move('fotosebelum/', $request->file('fotosebelum')->getClientOriginalName());
            $data->fotosebelum = $request->file('fotosebelum')->getClientOriginalName();
            $data->save();
        }
        if($request->hasFile('fotosesudah')) {
            $request->file('fotosesudah')->move('fotosesudah/', $request->file('fotosesudah')->getClientOriginalName());
            $data->fotosesudah = $request->file('fotosesudah')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('perbaikan.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Perbaikan $perbaikan)
    {
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('perbaikan.edit', [
            'item' => $perbaikan,
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Perbaikan $perbaikan)
    {
        $data = $request->all();

        $perbaikan->update($data);

        //dd($data);

        return redirect()->route('perbaikan.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Perbaikan $perbaikan)
    {
        $perbaikan->delete();
        return redirect()->route('perbaikan.index')->with('success', 'Data Telah dihapus');
    }

    //Report
    //  Laporan Buku perbaikan Filter
    public function cetakperbaikanpertanggal()
    {
        $perbaikan = Perbaikan::Paginate(10);

        return view('laporannya.laporanperbaikan', ['laporanperbaikan' => $perbaikan]);
    }

    public function filterdateperbaikan(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanperbaikan = Perbaikan::paginate(10);
        } else {
            $laporanperbaikan = Perbaikan::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanperbaikan', compact('laporanperbaikan'));
    }


    public function laporanperbaikanpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanperbaikan = Perbaikan::all();
        } else {
            $laporanperbaikan = Perbaikan::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanperbaikanpdf', compact('laporanperbaikan'));
        return $pdf->download('laporan_laporanperbaikan.pdf');
    }
}
