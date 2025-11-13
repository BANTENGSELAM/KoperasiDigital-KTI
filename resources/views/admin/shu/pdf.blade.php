<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan SHU Koperasi Digital - {{ $periode }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #444; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        .summary { margin-top: 15px; }
    </style>
</head>
<body>
    <h2>Laporan Pembagian SHU - {{ $periode }}</h2>

    <div class="summary">
        <p><strong>Total Pendapatan:</strong> Rp {{ number_format($totalPendapatan, 2) }}</p>
        <p><strong>Total Pengeluaran:</strong> Rp {{ number_format($totalPengeluaran, 2) }}</p>
        <p><strong>SHU Bersih:</strong> Rp {{ number_format($shuBersih, 2) }}</p>
    </div>

    <h3>Distribusi SHU ke Anggota</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Anggota</th>
                <th>Kontribusi (kg)</th>
                <th>Persentase</th>
                <th>Jumlah Diterima</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($distributions as $d)
                <tr>
                    <td>{{ $d->user->name ?? '-' }}</td>
                    <td>{{ $d->total_kontribusi }}</td>
                    <td>{{ $d->persentase }}%</td>
                    <td>Rp {{ number_format($d->jumlah_diterima, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p style="margin-top: 30px;">Dicetak pada: {{ now()->format('d M Y H:i') }}</p>
</body>
</html>
