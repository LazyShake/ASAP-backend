<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_article_tag_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTagTable extends Migration
{
    /**
     * Запустите миграцию.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained('articles', 'id_article')->onDelete('cascade'); // Связь с таблицей articles
            $table->foreignId('tag_id')->constrained('tags', 'id_tag')->onDelete('cascade'); // Связь с таблицей tags
            $table->timestamps();
        });
    }

    /**
     * Откатите миграцию.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}
