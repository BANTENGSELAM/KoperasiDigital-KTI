<!doctype html>
<html>
<head><meta charset="utf-8"><title>SHU</title></head>
<body>
<h2>Laporan SHU</h2>
<table border="1" cellpadding="6">
    <thead><tr><th>Nama</th><th>Kontribusi</th><th>Jumlah SHU</th></tr></thead>
    <tbody>
    @foreach($distributions as $d)
        <tr><td>{{ $d->user->name }}</td><td>{{ $d->kontribusi }}</td><td>Rp {{ number_format($d->jumlah_diterima,0) }}</td></tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
