<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BiodataField;

class BiodataFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [
            [
                'field_key'    => 'nik',
                'label'        => 'NIK',
                'type'         => 'text',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 1,
            ],
            [
                'field_key'    => 'tempat_lahir',
                'label'        => 'Tempat Lahir',
                'type'         => 'text',
                'is_required'  => true,
                'is_lock'      => false,
                'is_active'    => true,
                'sort_order'   => 2,
            ],
            [
                'field_key'    => 'tanggal_lahir',
                'label'        => 'Tanggal Lahir',
                'type'         => 'date',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 3,
            ],
            [
                'field_key'    => 'jenis_kelamin',
                'label'        => 'Jenis Kelamin',
                'type'         => 'select',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 4,
                'options'      => ['Laki-laki', 'Perempuan'],
            ],
            [
                'field_key'    => 'nama_ibu',
                'label'        => 'Nama Ibu Kandung',
                'type'         => 'text',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 5,
            ],
            [
                'field_key'    => 'sekolah_asal',
                'label'        => 'Sekolah Asal',
                'type'         => 'text',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 6,
            ],
            [
                'field_key'    => 'tahun_lulus',
                'label'        => 'Tahun Lulus',
                'type'         => 'number',
                'is_required'  => true,
                'is_lock'      => true,
                'is_active'    => true,
                'sort_order'   => 7,
            ],
        ];

        foreach ($fields as $field) {
            BiodataField::firstOrCreate(
                ['field_key' => $field['field_key']],
                $field
            );
        }
    }
}

