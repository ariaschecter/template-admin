<?php

namespace Database\Seeders;

use App\Models\SelectList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SelectListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo 'start seeder select list';

        // truncate agar data dibersihkan terlebih dahulu
        SelectList::truncate();
        $data = [
            ['type' => 'iku-1', 'name' => 'Mendapat pekerjaan yang layak'],
            ['type' => 'iku-1', 'name' => 'Melanjutkan studi'],
            ['type' => 'iku-1', 'name' => 'Menjadi wiraswasta'],

            ['type' => 'iku-2', 'name' => 'Pengalaman di luar kampus'],
            ['type' => 'iku-2', 'name' => 'Meraih prestasi paling rendah tingkat nasional'],

            ['type' => 'iku-3', 'name' => 'Berkegiatan tridharma'],
            ['type' => 'iku-3', 'name' => 'Bekerja sebagai praktisi'],
            ['type' => 'iku-3', 'name' => 'Membina mahasiswa'],

            ['type' => 'iku-4', 'name' => 'Berkualifikasi S3'],
            ['type' => 'iku-4', 'name' => 'Memiliki sertifikat kompetensi/profesi'],
            ['type' => 'iku-4', 'name' => 'Pengalaman kerja sebagai praktisi'],

            ['type' => 'iku-6', 'name' => 'MoU'],
            ['type' => 'iku-6', 'name' => 'MoA'],
            ['type' => 'iku-6', 'name' => 'IA'],

            ['type' => 'iku-7', 'name' => 'case method'],
            ['type' => 'iku-7', 'name' => 'team-based project'],
        ];

        foreach ($data as $item) {
            SelectList::create($item);
        }

        echo 'done seeder select list';
    }
}
