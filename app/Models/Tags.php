<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'tags';
    protected $primaryKey = 'id_tag';

    /**
     * Атрибуты, которые можно массово заполнять.
     */
    protected $fillable = [
        'name_tag',
    ];

    protected static function booted()
{
    static::deleting(function ($tag) {
        // Проверяем, есть ли связанные статьи
        if ($tag->articles()->exists()) {
            throw new \Exception('Невозможно удалить тег, так как он связан с статьями.');
        }
    });
}


    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }


}
