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
        Schema::create('biodata_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_key')->unique(); // nik, tanggal_lahir, dll
            $table->string('label');               // NIK, Tanggal Lahir
            $table->string('type');                // text, number, date, select, textarea
            $table->boolean('is_required')->default(false);
            $table->boolean('is_lock')->default(false); // wajib SAKTI, tidak bisa dihapus
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->json('options')->nullable();   // untuk select
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata_fields');
    }
};
