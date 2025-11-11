<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
   <!-- Gunakan format cetak A4 landscape -->
    <style>
        @page {
            size: A4 landscape;
            margin: 20mm;
        }
    </style>

    <style type="text/css">
        /* ======= Global ======= */
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        h4, h5 {
            margin: 0;
            padding: 0;
        }

        /* ======= Table Layout ======= */
        table {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 4px solid #000;
            table-layout: auto;
        }

        table tr td,
        table tr th {
            font-size: 9pt;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000;
            padding: 5px;
            word-wrap: break-word;
        }

        /* ======= Header Table ======= */
        #warnatable th {
            background-color: #fe0000;
            color: #000;
            padding-top: 8px;
            padding-bottom: 8px;
            white-space: nowrap;
        }

        /* ======= Baris Ganjil/Genap ======= */
        #warnatable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #warnatable tr:hover {
            background-color: #ddd;
        }

        /* ======= Lebar Kolom ======= */
        #warnatable th:nth-child(1)  { width: 4%; }
        #warnatable th:nth-child(2)  { width: 9%; }
        #warnatable th:nth-child(3)  { width: 8%; }
        #warnatable th:nth-child(4)  { width: 9%; }
        #warnatable th:nth-child(5)  { width: 8%; }
        #warnatable th:nth-child(6)  { width: 9%; }
        #warnatable th:nth-child(7)  { width: 10%; }
        #warnatable th:nth-child(8)  { width: 7%; }
        #warnatable th:nth-child(9)  { width: 7%; }
        #warnatable th:nth-child(10) { width: 7%; }
        #warnatable th:nth-child(11) { width: 7%; }
        #warnatable th:nth-child(12) { width: 7%; }

        /* ======= Bagian Tanda Tangan ======= */
        .signature {
            margin-top: 50px;
            text-align: right;
            font-size: 14px;
        }

        .signaturesewa {
            margin-top: 50px;
            text-align: left;
            font-size: 14px;
        }

        /* ======= Bagian Tanggal ======= */
        .date-container {
            font-family: Arial, sans-serif;
            text-align: left;
            font-size: 14px;
            margin-top: 20px;
        }

        /* ======= Saat Cetak ======= */
        @media print {
            body {
                margin: 10mm;
            }

            table {
                font-size: 8pt;
            }

            th, td {
                padding: 3px;
            }

            .signature, .signaturesewa {
                font-size: 12px;
            }
        }
    </style>


    <div class="overflow-x: auto;">
        <table width="100%">
            <tr>
                <td><img src="{{ public_path('assets/logo1.png') }}" alt="logo" width="140px"></td>
                <td class="tengah">
                    <h4> TELKOM AKSES </h4>
                    <br>
                    <p>Jalan Jenderal Ahmad Yani KM 23, Landasan Ulin, Landasan Ulin Barat, Kec. Liang Anggang, Kota
                        Banjarbaru</p>
                </td>
            </tr>
        </table>
    </div>

    <center>
        <h5 class="mt-4">Rekap Laporan Surat Pemasangan</h5>
    </center>



    <br>

    <table class="table table-bordered" id="warnatable">
        <thead>
            <tr>
                <th class="px-6 py-2">No</th>
                <th class="px-6 py-2">No Pemasangan</th>
                <th class="px-6 py-2">Tanggal</th>
                <th class="px-6 py-2">Client</th>
                <th class="px-6 py-2">Alat</th>
                <th class="px-6 py-2">Teknisi</th>
                <th class="px-6 py-2">Lokasi</th>
                <th class="px-6 py-2">Kapasitas</th>
                <th class="px-6 py-2">ODC Terhubung</th>
                <th class="px-6 py-2">Waktu Mulai</th>
                <th class="px-6 py-2">Waktu Selesai</th>
                <th class="px-6 py-2">Total Jam</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanpemasangan as $item)
                @php
                    $mulai = \Carbon\Carbon::parse($item->waktumulai);
                    $selesai = \Carbon\Carbon::parse($item->waktuselesai);
                    $total = $selesai->diff($mulai); // Selisih waktu
                @endphp
                <tr>
                    <td class="px-6 py-2 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-2">{{ $item->nopemasangan ?? '-' }}</td>
                    <td class="px-6 py-2">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="px-6 py-2">{{ $item->masterclient->nama }}</td>
                    <td class="px-6 py-2">{{ $item->masteralat->nama }}</td>
                    <td class="px-6 py-2">{{ $item->masterteknisi->nama }}</td>
                    <td class="px-6 py-2">{{ $item->lokasi }}</td>
                    <td class="px-6 py-2">{{ $item->kapasitas }}</td>
                    <td class="px-6 py-2">{{ $item->odcterhubung }}</td>
                    <td class="px-6 py-2">{{ $mulai->format('H:i') }}</td>
                    <td class="px-6 py-2">{{ $selesai->format('H:i') }}</td>
                    <td class="px-6 py-2">
                        {{ $total->h }} jam {{ $total->i }} menit
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="date-container">
        Banjarmasin, <span class="formatted-date">{{ now()->format('d-m-Y') }}</span>
    </div>
    <p class="signature">(Supervisor)</p>

</body>

</html>
