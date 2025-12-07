<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pmb_final_candidates', function (Blueprint $table) {

            // 1️⃣ DROP FOREIGN KEYS (if exists)
            try {
                $table->dropForeign(['study_program_id']);
            } catch (\Exception $e) {}

            try {
                $table->dropForeign(['entry_path_id']);
            } catch (\Exception $e) {}

            try {
                $table->dropForeign(['pmb_period_id']);
            } catch (\Exception $e) {}

            try {
                $table->dropForeign(['pmb_wave_id']);
            } catch (\Exception $e) {}

            // 2️⃣ DROP OLD COLUMNS
            if (Schema::hasColumn('pmb_final_candidates', 'study_program_id')) {
                $table->dropColumn('study_program_id');
            }
            if (Schema::hasColumn('pmb_final_candidates', 'entry_path_id')) {
                $table->dropColumn('entry_path_id');
            }
            if (Schema::hasColumn('pmb_final_candidates', 'pmb_period_id')) {
                $table->dropColumn('pmb_period_id');
            }
            if (Schema::hasColumn('pmb_final_candidates', 'pmb_wave_id')) {
                $table->dropColumn('pmb_wave_id');
            }

            // 3️⃣ ADD NEW NAME COLUMNS
            $table->string('study_program_name')->nullable();
            $table->string('entry_path_name')->nullable();
            $table->string('pmb_period_name')->nullable();
            $table->string('pmb_wave_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('pmb_final_candidates', function (Blueprint $table) {

            // Add old columns back (rollback)
            $table->unsignedBigInteger('study_program_id')->nullable();
            $table->unsignedBigInteger('entry_path_id')->nullable();
            $table->unsignedBigInteger('pmb_period_id')->nullable();
            $table->unsignedBigInteger('pmb_wave_id')->nullable();

            // Drop name columns
            $table->dropColumn([
                'study_program_name',
                'entry_path_name',
                'pmb_period_name',
                'pmb_wave_name'
            ]);
        });
    }
};
