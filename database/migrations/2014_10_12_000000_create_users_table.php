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
        Schema::create('tb_users', function (Blueprint $table) {
            $table->id('id_users');
            $table->string('username', 255)->nullable();
            $table->text('pw_users')->nullable();
            $table->string('nama_users', 255)->nullable();
            $table->string('ttl_users', 255)->nullable();
            $table->text('alamat_users')->nullable();
            $table->string('notelp_users', 50)->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_users');
    }
};
