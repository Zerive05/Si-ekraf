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
            $table->unsignedBigInteger('id_penjual');
            $table->unsignedBigInteger('id_pembeli');
            $table->unsignedBigInteger('id_produk');
            $table->integer('jmlprod');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_penjual')->references('id')->on('penjuals');
            $table->foreign('id_pembeli')->references('id')->on('pembelis');
            $table->foreign('id_produk')->references('id')->on('produks');
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
