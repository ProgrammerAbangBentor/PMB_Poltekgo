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
        Schema::create('pmb_waves', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pmb_period_id')->constrained()->cascadeOnDelete();
            $table->string('nama_gelombang');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->decimal('biaya_pendaftaran', 12, 2)->default(0);
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pmb_waves');
    }
};
