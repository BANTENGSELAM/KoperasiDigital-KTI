<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Sales;
use App\Models\Ledger;
use App\Models\Contribution;
use App\Models\Distribution;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        // Comment data dummy - uncomment jika diperlukan untuk testing
        
        /*
        // Buat user restoran/UMKM
        $users = collect([
            ['name' => 'Restoran A', 'email' => 'restoa@test.com'],
            ['name' => 'Restoran B', 'email' => 'restob@test.com'],
            ['name' => 'Restoran C', 'email' => 'restoc@test.com'],
        ])->map(function ($u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                ['name' => $u['name'], 'password' => Hash::make('password')]
            );
            $user->assignRole('restoran_umkm');
            return $user;
        });

        // Data penjualan pupuk (sales)
        for ($i = 1; $i <= 6; $i++) {
            Sales::create([
                'batch_id' => null,
                'pembeli' => 'Koperasi Petani Bulan ' . $i,
                'jumlah_kg' => rand(500, 1000),
                'harga_per_kg' => 5000,
                'total' => rand(500, 1000) * 5000,
                'tanggal' => Carbon::now()->subMonths(6 - $i),
            ]);
        }

        // Data pengeluaran operasional (ledger)
        for ($i = 1; $i <= 6; $i++) {
            Ledger::create([
                'kategori' => 'Operasional Bulan ' . $i,
                'type' => 'expense',
                'amount' => rand(1000000, 3000000),
                'tanggal' => Carbon::now()->subMonths(6 - $i),
                'catatan' => 'Biaya operasional bulanan',
            ]);
        }

        // Kontribusi sampah per restoran
        foreach ($users as $user) {
            Contribution::create([
                'user_id' => $user->id,
                'berat_sampah' => rand(100, 500),
                'tanggal' => now()->subDays(rand(1, 30)),
            ]);
        }

        // Distribusi SHU contoh
        $totalPendapatan = Sales::sum('total');
        $totalPengeluaran = Ledger::where('type', 'expense')->sum('amount');
        $shuBersih = $totalPendapatan - $totalPengeluaran;
        $totalKontribusi = Contribution::sum('berat_sampah');

        foreach (Contribution::with('user')->get() as $c) {
            $persentase = $c->berat_sampah / $totalKontribusi;
            $jumlah_diterima = $shuBersih * $persentase;
            Distribution::create([
                'user_id' => $c->user_id,
                'total_kontribusi' => $c->berat_sampah,
                'persentase' => round($persentase * 100, 2),
                'jumlah_diterima' => round($jumlah_diterima, 2),
                'periode' => now()->format('Y-m'),
            ]);
        }
        */
    }
}
