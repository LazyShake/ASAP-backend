<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class progress extends Model
{
    use HasFactory;

    // Имя таблицы
    protected $table = 'progress';

    // Первичный ключ
    protected $primaryKey = 'id_progress';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'before',
        'after',
        'id_profession',
    ];

    public static function getProgressByProfession($professionId)
    {
        return self::where('id_profession', $professionId)->get();
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    // Указать, что timestamps присутствуют
    public $timestamps = true;
}
