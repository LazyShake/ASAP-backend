<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_type'; // Укажите нестандартное имя первичного ключа
    public $incrementing = true; // Если это автоинкремент
    protected $keyType = 'int';
    
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'types';

    // Указываем столбцы, которые можно массово присваивать
    protected $fillable = [
        'name_type',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'type_id', 'id_type');
    }

    // Пример проверки перед удалением, если тип используется в статьях
    /*protected static function booted()
    {
        static::deleting(function ($type) {
            // Получаем все статьи, ссылающиеся на данный тип
            $articlesUsingType = $type->articles;
        
            if ($articlesUsingType->isNotEmpty()) {
                // Формируем список названий статей
                $articleTitles = $articlesUsingType->pluck('name_article')->implode(', ');
        
                // Формируем отформатированный JSON
                $response = [
                    'error' => true,
                    'message' => 'Невозможно удалить тип, так как он используется в статьях.',
                    'details' => [
                        'relation' => 'articles',  // Указываем, с какой сущностью связан
                        'related_model' => 'Article',  // Указываем модель, с которой связан
                        'articles' => $articleTitles,  // Список статей, использующих данный тип
                    ]
                ];
        
                // Выбрасываем исключение с отформатированным JSON
                throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            }
        });
        
    }*/

    // Указываем, что Laravel не должен ожидать поля timestamps, если их нет
    public $timestamps = true;
}