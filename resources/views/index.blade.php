<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Pickup Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('pickups.create') }}" class="btn btn-primary mb-3">+ Permintaan Baru</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Lokasi</th>
                                <th>Jenis</th>
                                <th>Status</th>
                                <th>Berat (kg)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pickups as $p)
                                <tr>
                                    <td>{{ $p->tanggal }}</td>
                                    <td>{{ $p->lokasi }}</td>
                                    <td>{{ $p->jenis }}</td>
                                    <td>{{ ucfirst($p->status) }}</td>
                                    <td>{{ $p->berat_kg }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
