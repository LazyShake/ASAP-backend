<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('first_images', function (Blueprint $table) {
            $table->id('id_first_image');
            $table->string('image', 255)->nullable(); // Путь к изображению
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('first_images');
    }
};
