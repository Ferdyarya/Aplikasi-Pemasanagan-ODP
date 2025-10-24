<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbaikan Berhasil</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .email-container {
            background-color: #ffffff;
            max-width: 600px;
            margin: 30px auto;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 25px 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .content {
            padding: 25px 30px;
        }
        .content h2 {
            color: #28a745;
            margin-top: 0;
            font-size: 20px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .details-table th, .details-table td {
            text-align: left;
            padding: 8px 10px;
            border-bottom: 1px solid #e0e0e0;
        }
        .details-table th {
            width: 35%;
            color: #555;
        }
        .success-badge {
            display: inline-block;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-top: 15px;
        }
        .footer {
            background-color: #f1f3f5;
            text-align: center;
            padding: 15px;
            font-size: 13px;
            color: #666;
        }
        .timestamp {
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        .timestamp span {
            font-weight: bold;
            color: #28a745;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="header">
            <h1>Perbaikan Berhasil ✅</h1>
        </div>

        <div class="content">
            <h2>Perbaikan sudah berhasil dilakukan</h2>
            <p>Berikut detail perbaikan yang telah selesai:</p>

            <table class="details-table">
                <tr>
                    <th>Tanggal</th>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal ?? now())->format('d M Y') }}</td>
                </tr>
                <tr>
                    <th>Alat</th>
                    <td>{{ $data->masteralat->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Teknisi</th>
                    <td>{{ $data->masterteknisi->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Lokasi</th>
                    <td>{{ $data->lokasi ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>{{ $data->keterangan ?? '-' }}</td>
                </tr>
            </table>

            <div class="success-badge">
                ✅ Perbaikan sudah berhasil!
            </div>

            <div class="timestamp">
                🕒 <span>Waktu Selesai:</span>
                {{ \Carbon\Carbon::parse($data->updated_at ?? now())->translatedFormat('d F Y, H:i:s') }}
            </div>
        </div>

        <div class="footer">
            Email ini dikirim otomatis oleh sistem perbaikan.<br>
            Mohon tidak membalas email ini.
        </div>
    </div>

</body>
</html>
