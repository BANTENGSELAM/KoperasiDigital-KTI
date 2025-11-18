<x-admin-layout title="Dashboard Petugas">

<h1 class="text-2xl font-bold mb-4">Tugas Hari Ini</h1>

@if($tugasHariIni->isEmpty())
    <div class="bg-white p-4 rounded shadow">
        Tidak ada tugas hari ini.
    </div>
@else
<div class="bg-white p-4 rounded shadow">
    <table class="min-w-full text-sm border">
        <tr class="bg-gray-100">
            <th class="border p-2">Tanggal</th>
            <th class="border p-2">Lokasi</th>
            <th class="border p-2">Status</th>
        </tr>
        @foreach($tugasHariIni as $t)
        <tr>
            <td class="border p-2">{{ $t->tanggal }}</td>
            <td class="border p-2">{{ $t->lokasi }}</td>
            <td class="border p-2">{{ $t->status }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endif

</x-admin-layout>
