<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buat Batch Pengolahan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                <form method="POST" action="{{ route('batches.store') }}">
                    @csrf
                    <p class="mb-3">Pilih pickup yang sudah selesai untuk dimasukkan ke batch ini:</p>

                    @forelse($pickups as $p)
                        <div>
                            <input type="checkbox" name="pickup_ids[]" value="{{ $p->id }}">
                            <label>{{ $p->tanggal }} — {{ $p->lokasi }} ({{ $p->berat_kg }} kg)</label>
                        </div>
                    @empty
                        <p>Tidak ada pickup yang siap diolah.</p>
                    @endforelse

                    <button type="submit" class="btn btn-success mt-4">Buat Batch</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
