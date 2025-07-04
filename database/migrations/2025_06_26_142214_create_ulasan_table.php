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
    Schema::create('ulasan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('pesanan_id')->constrained()->onDelete('cascade');  // Relasi ke pesanan
        $table->foreignId('pelanggan_id')->constrained('users')->onDelete('cascade');  // Relasi ke user
        $table->integer('rating')->default(5);  // Rating 1-5
        $table->text('komentar')->nullable();  // Komentar ulasan
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
