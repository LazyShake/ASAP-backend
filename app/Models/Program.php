<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_program';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'programs';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'name_module',
        'content_module',
        'id_profession',
        'number_module',
    ];

    /*protected static function booted()
{
    static::deleting(function ($program) {
        $relations = [
            'profession' => 'Профессия',
        ];
    
        $usedIn = [];
    
        // Проверяем, есть ли связи с профессией
        foreach ($relations as $relation => $name) {
            if ($program->$relation()->exists()) {
                $usedIn[] = $name;
            }
        }
    
        // Если есть связи, выбрасываем исключение с отформатированным JSON
        if (!empty($usedIn)) {
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить программу, так как она связана с: ' . implode(', ', $usedIn),
                'details' => [
                    'used_in' => $usedIn,  // Список мест, где используется программа
                ]
            ];
    
            // Выбрасываем исключение с отформатированным JSON
            throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    });
    
}*/

    protected $casts = [
        'content_module' => 'array', // Автоматическое преобразование JSON в массив и обратно
    ];
    

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;

    // Отношение с профессией (обратная связь)
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profession');
    }

    
}
