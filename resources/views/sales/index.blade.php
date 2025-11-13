<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Penjualan Pupuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('sales.create') }}" class="btn btn-primary mb-4">+ Catat Penjualan</a>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Kode Batch</th>
                            <th>Pembeli</th>
                            <th>Jumlah (kg)</th>
                            <th>Total (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($sales as $s)
                            <tr>
                                <td>{{ $s->tanggal }}</td>
                                <td>{{ $s->batch->kode_batch }}</td>
                                <td>{{ $s->pembeli }}</td>
                                <td>{{ $s->jumlah_kg }}</td>
                                <td>{{ number_format($s->total, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500">Belum ada penjualan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
