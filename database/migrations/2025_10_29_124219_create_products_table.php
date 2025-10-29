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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Untuk nama menu
            $table->integer('price'); // Harga (simpan sebagai integer, misal: 15000)
            $table->text('description')->nullable(); // Deskripsi singkat
            $table->string('image_path')->nullable(); // Path/link ke foto menu
            $table->boolean('is_available')->default(true); // Stok (true = Tersedia, false = Habis)
            $table->timestamps(); // otomatis membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
