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
            $table->timestamp('waktu_pesan')->nullable()->after('status_pesanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('pesanans', function (Blueprint $table) {
        $table->dropColumn('waktu_pesan');
    });
}
};
