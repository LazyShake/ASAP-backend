<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id('id_partners');
            $table->string('name_partners', 255);
            $table->string('logo_partners', 255)->nullable(); // Путь к изображению
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partners');
    }
};
