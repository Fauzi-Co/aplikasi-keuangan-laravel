<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pengeluaran', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 255);
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->dateTime('tgl')->nullable();
            $table->timestamp('created_at')->useCurrent();

            // Optional foreign key if kategori table exists
            // $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengeluaran');
    }
};
