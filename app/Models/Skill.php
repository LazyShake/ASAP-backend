<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    // Имя таблицы
    protected $table = 'skills';

    // Первичный ключ
    protected $primaryKey = 'id_skills';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'text',
        'name',
    ];

    protected static function booted()
{
    static::deleting(function ($skill) {
        // Проверяем, есть ли связанные профессии
        if ($skill->profession()->exists()) {
            throw new \Exception('Невозможно удалить навык, так как он связан с профессиями.');
        }
    });
}


    // Указать, что timestamps присутствуют
    public $timestamps = true;

    // Связь с моделью Profession (многие к одному)
    public function profession()
    {
        return $this->belongsToMany(Profession::class, 'profession_skill', 'id_skills', 'id_profession');
    }
}
