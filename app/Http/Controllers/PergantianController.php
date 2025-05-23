<?php

namespace App\Http\Controllers;

use App\Models\Masteralat;
use App\Models\Pergantian;
use Illuminate\Http\Request;
use App\Models\Masterteknisi;

class PergantianController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $pergantian = Pergantian::whereHas('masteralat', function($query) use ($request) {
                $query->where('nama', 'LIKE', '%' . $request->search . '%');
            })->paginate(10);
        } else {
            $pergantian = Pergantian::paginate(10);
        }

        return view('pergantian.index', [
            'pergantian' => $pergantian
        ]);
    }


    public function create()
    {
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('pergantian.create', [
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
        return view('pergantian.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
    {
        $data = Pergantian::create($request->all());
        if($request->hasFile('sebelumganti')) {
            $request->file('sebelumganti')->move('sebelumganti/', $request->file('sebelumganti')->getClientOriginalName());
            $data->sebelumganti = $request->file('sebelumganti')->getClientOriginalName();
            $data->save();
        }
        if($request->hasFile('sesudahganti')) {
            $request->file('sesudahganti')->move('sesudahganti/', $request->file('sesudahganti')->getClientOriginalName());
            $data->sesudahganti = $request->file('sesudahganti')->getClientOriginalName();
            $data->save();
        }

        return redirect()->route('pergantian.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Pergantian $pergantian)
    {
        $masteralat = Masteralat::all();
        $masterteknisi = Masterteknisi::all();

        return view('pergantian.edit', [
            'item' => $pergantian,
            'masteralat' => $masteralat,
            'masterteknisi' => $masterteknisi,
        ]);
    }


    public function update(Request $request, Pergantian $pergantian)
    {
        $data = $request->all();

        $pergantian->update($data);

        //dd($data);

        return redirect()->route('pergantian.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Pergantian $pergantian)
    {
        $pergantian->delete();
        return redirect()->route('pergantian.index')->with('success', 'Data Telah dihapus');
    }

    //Report
    //  Laporan Buku pergantian Filter
    public function cetakpergantianpertanggal()
    {
        $pergantian = Pergantian::Paginate(10);

        return view('laporannya.laporanpergantian', ['laporanpergantian' => $pergantian]);
    }

    public function filterdatepergantian(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanpergantian = Pergantian::paginate(10);
        } else {
            $laporanpergantian = Pergantian::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanpergantian', compact('laporanpergantian'));
    }


    public function laporanpergantianpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanpergantian = Pergantian::all();
        } else {
            $laporanpergantian = Pergantian::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanpergantianpdf', compact('laporanpergantian'));
        return $pdf->download('laporan_laporanpergantian.pdf');
    }
}
