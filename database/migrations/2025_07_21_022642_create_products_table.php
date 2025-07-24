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
    $table->id(); // Ini sudah auto_increment & primary key
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->string('title');
    $table->string('slug');
    $table->text('meta_desc')->nullable();
    $table->text('content')->nullable();
    $table->string('image')->nullable();
    $table->boolean('status')->default(true);

    // ✅ Perbaikan di bawah ini:
    $table->unsignedInteger('price')->nullable(); // TIDAK auto_increment
    $table->unsignedTinyInteger('discount')->default(0);
    $table->unsignedInteger('stock')->default(0);

    $table->timestamps();
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
