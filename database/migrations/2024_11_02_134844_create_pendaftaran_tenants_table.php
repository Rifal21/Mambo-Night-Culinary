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
        Schema::create('pendaftaran_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kategori');
            $table->string('name');
            $table->string('pemilik');
            $table->string('brand');
            $table->string('ig');
            $table->string('tt');
            $table->string('email')->unique();
            $table->string('alamat');
            $table->string('asli');
            $table->string('phone');
            $table->string('fileimage');
            $table->string('priceRange');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftaran_tenants');
    }
};
