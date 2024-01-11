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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->Integer('id_penjual');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_produk');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_pembeli', 'id_produk')->references('id')->on('users', 'produks');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};