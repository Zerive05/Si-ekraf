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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama', 100);
            $table->string('deskripsi');
            $table->float('hargap');
            $table->float('hargaj');
            $table->float('beban')->nullable();
            $table->unsignedBigInteger('id_penjual');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_penjual')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
