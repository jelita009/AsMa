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
        Schema::create('aspiration_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('aspiration_id');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unique(['aspiration_id', 'mahasiswa_id']);
            $table->foreign('aspiration_id')->references('id')->on('aspirations')->onDelete('cascade');
            $table->foreign('mahasiswa_id')->references('id')->on('mahasiswas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspiration_votes');
    }
};
