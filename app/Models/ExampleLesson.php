<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExampleLesson extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_example_lesson';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'example_lessons';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'name_example_lesson',
        'link',
        'id_profession',
    ];

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;

    // Отношение с профессией (обратная связь)
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profession', 'id_profession');
    }
}
