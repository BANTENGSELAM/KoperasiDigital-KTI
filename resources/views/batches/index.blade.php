<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Batch Pengolahan Pupuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('admin.batches.create') }}" class="btn btn-primary mb-4">+ Batch Baru</a>

            <div class="bg-white shadow sm:rounded-lg p-6">
                <table class="table table-bordered w-full">
                    <thead>
                        <tr>
                            <th>Kode Batch</th>
                            <th>Berat Masuk</th>
                            <th>Berat Keluar</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($batches as $b)
                            <tr>
                                <td>{{ $b->kode_batch }}</td>
                                <td>{{ $b->berat_masuk_kg }}</td>
                                <td>{{ $b->berat_keluar_kg ?? '-' }}</td>
                                <td>{{ ucfirst($b->status) }}</td>
                                <td>{{ $b->tgl_mulai }}</td>
                                <td>{{ $b->tgl_selesai ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center">Belum ada batch pengolahan.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
