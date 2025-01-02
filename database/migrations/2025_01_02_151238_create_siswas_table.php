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
        Schema::create('siswas', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->uuid('id_jurusan');
            $table->uuid('id_tingkat');
            $table->string('kode')->nullable();
            $table->string('nama');
            $table->tinyInteger('jenis_kelamin');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('nomor');
            $table->date('start_date');

            $table->foreign('id_jurusan')->references('id')->on('jurusans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_tingkat')->references('id')->on('tingkats')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
