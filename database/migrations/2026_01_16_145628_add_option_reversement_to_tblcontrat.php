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
        Schema::connection('mysql')->table('tblcontrat', function (Blueprint $table) {
            $table->string('mode_reserversement')->after('dureerente')->nullable();
            $table->string('echeance_reversement')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tblcontrat', function (Blueprint $table) {
            //
        });
    }
};
