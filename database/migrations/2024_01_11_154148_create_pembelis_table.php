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
        Schema::create('pembelis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('jenisk', ['pria', 'wanita']);
            $table->bigInteger('nohp');
            $table->string('alamat', 150);
            $table->enum('role', ['penjual', 'pembeli']);
            $table->float('saldo');
            $table->timestamp('email_verified_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelis');
    }
};
