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
        Schema::create('document_fields', function (Blueprint $table) {
            $table->id();
            $table->string('field_key')->unique(); // contoh: ktp, ijazah, pas_foto
            $table->string('label');               // contoh: "KTP / KK", "Ijazah"
            $table->string('description')->nullable();
            $table->string('allowed_types')->default('jpg,png,pdf'); // ekstensi diperbolehkan
            $table->integer('max_size')->default(2048); // KB
            $table->boolean('is_required')->default(true);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_fields');
    }
};
