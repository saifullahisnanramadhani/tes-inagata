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
    Schema::create('articles', function (Blueprint $table) {
        $table->id(); // Primary key artikel

        $table->string('title'); // Judul artikel
        $table->text('content'); // Isi artikel
        $table->string('author'); // Nama penulis

        // Foreign key ke tabel categories
        $table->foreignId('category_id')
              ->constrained()
              ->onDelete('cascade');

        $table->timestamps(); // created_at & updated_at
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
