<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan SHU - Koperasi Digital</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { text-align: center; color: #333; margin-bottom: 5px; }
        .header { text-align: center; margin-bottom: 20px; }
        .info { margin-bottom: 20px; }
        .info table { width: 100%; }
        .info td { padding: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        .total { font-weight: bold; background-color: #f0f0f0; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Sisa Hasil Usaha (SHU)</h2>
        <p>Koperasi Digital KTI</p>
        <p style="font-size: 12px;">Dicetak pada: {{ date('d F Y, H:i') }} WIB</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td width="50%"><strong>Total Pendapatan:</strong></td>
                <td>Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td><strong>Total Kontribusi Sampah:</strong></td>
                <td>{{ number_format($totalKontribusi ?? 0, 2, ',', '.') }} kg</td>
            </tr>
            <tr>
                <td><strong>Total SHU Dibagikan:</strong></td>
                <td>Rp {{ number_format($totalSHU ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="40%">Nama Anggota</th>
                <th width="20%">Kontribusi (kg)</th>
                <th width="15%">Persentase</th>
                <th width="20%">Jumlah SHU</th>
            </tr>
        </thead>
        <tbody>
        @php $total = 0; @endphp
        @foreach($distributions as $index => $d)
            @php $total += $d->jumlah_diterima; @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $d->user->name }}</td>
                <td class="text-right">{{ number_format($d->kontribusi, 2, ',', '.') }}</td>
                <td class="text-right">
                    {{ $totalKontribusi > 0 ? number_format(($d->kontribusi / $totalKontribusi) * 100, 2) : 0 }}%
                </td>
                <td class="text-right">Rp {{ number_format($d->jumlah_diterima, 0, ',', '.') }}</td>
            </tr>
        @endforeach
        <tr class="total">
            <td colspan="4" class="text-right">TOTAL SHU:</td>
            <td class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</td>
        </tr>
        </tbody>
    </table>
</body>
</html>
