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
        Schema::table('appointments', function (Blueprint $table) {
            if (!Schema::hasColumn('appointments', 'doctor_instructions')) {
                $table->text('doctor_instructions')->nullable()->after('medical_history');
            }
            if (!Schema::hasColumn('appointments', 'medicine_list')) {
                $table->text('medicine_list')->nullable()->after('doctor_instructions');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'medicine_list')) {
                $table->dropColumn('medicine_list');
            }
            if (Schema::hasColumn('appointments', 'doctor_instructions')) {
                $table->dropColumn('doctor_instructions');
            }
        });
    }
};
