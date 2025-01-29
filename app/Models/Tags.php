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
            // Формируем отформатированный JSON
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить тег, так как он связан с статьями.',
                'details' => [
                    'relation' => 'articles',  // Указываем, с какой сущностью связан
                    'related_model' => 'Article',  // Указываем модель, с которой связан
                ]
            ];
    
            // Выбрасываем исключение с отформатированным JSON
            throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    });
    
}


    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag', 'tag_id', 'article_id');
    }


}
