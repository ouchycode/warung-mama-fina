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
    Schema::table('pesanans', function (Blueprint $table) {
        $table->string('alamat_pengantaran')->after('waktu_pesan')->nullable();
    });
}

public function down(): void
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->dropColumn('alamat_pengantaran');
    });
}

};
