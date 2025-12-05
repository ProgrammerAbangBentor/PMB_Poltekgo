<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();

            // Relasi utama
            $table->foreignId('pmb_period_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('pmb_wave_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('study_program_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('entry_path_id')->nullable()->constrained()->nullOnDelete();

            // Info akun
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('no_hp')->nullable();
            $table->string('password');

            // Nomor pendaftaran
            $table->string('no_pendaftaran')->unique();

            // Status alur pendaftaran
            $table->string('status_registrasi')->default('REGISTERED');

            // Pembayaran pendaftaran (Step 3)
            $table->timestamp('registration_fee_paid_at')->nullable();

            // Biodata & file (Step 4 & 5)
            $table->boolean('is_biodata_complete')->default(false);
            $table->boolean('is_documents_complete')->default(false);
            $table->boolean('is_finalized')->default(false);

            // Seleksi berkas (Step 6)
            $table->boolean('is_file_selection_passed')->default(false);
            $table->timestamp('file_selection_decided_at')->nullable();

            // Seleksi masuk (Step 7)
            $table->boolean('is_entrance_selection_passed')->default(false);
            $table->timestamp('entrance_selection_decided_at')->nullable();

            // Registrasi ulang (Step 9)
            $table->boolean('is_re_registration_complete')->default(false);
            $table->timestamp('re_registration_completed_at')->nullable();

            // Sinkronisasi ke SAKTI (nantinya)
            $table->timestamp('synced_to_sakti_at')->nullable();

            // Soft Delete & Timestamps
            $table->softDeletes();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
