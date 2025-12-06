<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
    {
        Schema::create('pmb_final_candidates', function (Blueprint $table) {
            $table->id();

            // Relasi ke applicant asli
            $table->foreignId('applicant_id')->constrained()->onDelete('cascade');

            /*
            |--------------------------------------------------------------------------
            | DATA WAJIB SAKTI (BERDASARKAN YANG ADA BINTANG)
            |--------------------------------------------------------------------------
            */
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jenis_kelamin');
            $table->string('agama');
            $table->string('kewarganegaraan');

            $table->string('nik');
            $table->string('nisn')->nullable(); // beberapa kampus opsional
            $table->string('npwp')->nullable();

            // Alamat
            $table->string('jalan')->nullable();
            $table->string('dusun')->nullable();
            $table->string('rt')->nullable();
            $table->string('rw')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kode_pos')->nullable();

            // Kontak
            $table->string('hp');
            $table->string('email');

            // Info tambahan
            $table->boolean('penerima_kps')->nullable();
            $table->string('alat_transportasi')->nullable();
            $table->string('jenis_tinggal')->nullable();

            /*
            |--------------------------------------------------------------------------
            | DATA ORANG TUA / WALI
            |--------------------------------------------------------------------------
            */
            // Ibu
            $table->string('nama_ibu');
            $table->date('tanggal_lahir_ibu')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('penghasilan_ibu')->nullable();

            // Ayah
            $table->string('nama_ayah')->nullable();
            $table->date('tanggal_lahir_ayah')->nullable();
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('penghasilan_ayah')->nullable();

            // Wali
            $table->string('nama_wali')->nullable();
            $table->date('tanggal_lahir_wali')->nullable();
            $table->string('pendidikan_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('penghasilan_wali')->nullable();

            /*
            |--------------------------------------------------------------------------
            | INFORMASI PMB
            |--------------------------------------------------------------------------
            */
            $table->foreignId('study_program_id')->nullable()->constrained();
            $table->foreignId('entry_path_id')->nullable()->constrained();
            $table->foreignId('pmb_period_id')->nullable()->constrained();
            $table->foreignId('pmb_wave_id')->nullable()->constrained();

            /*
            |--------------------------------------------------------------------------
            | STATUS PEMBAYARAN (BOLEH NULL)
            | Ada 5 jenis pembayaran sesuai tabel biaya kamu
            |--------------------------------------------------------------------------
            */


            $table->boolean('biaya_pembangunan_lunas')->nullable();
            $table->timestamp('biaya_pembangunan_at')->nullable();

            $table->boolean('biaya_pkkbm_lunas')->nullable();
            $table->timestamp('biaya_pkkbm_at')->nullable();

            $table->boolean('biaya_spp_lunas')->nullable();
            $table->timestamp('biaya_spp_at')->nullable();

            $table->boolean('biaya_praktikum_lunas')->nullable();
            $table->timestamp('biaya_praktikum_at')->nullable();

            /*
            |--------------------------------------------------------------------------
            | STATUS KESIAPAN & SINKRONISASI
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_ready_to_sync')->default(true);
            $table->timestamp('synced_to_sakti_at')->nullable();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmb_final_candidates');
    }
};
