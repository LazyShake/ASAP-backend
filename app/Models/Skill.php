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

    // Указать, что timestamps присутствуют
    public $timestamps = true;

    // Связь с моделью Profession (многие к одному)
    public function profession()
    {
        return $this->belongsToMany(Profession::class, 'profession_skill', 'id_skills', 'id_profession');
    }
}
