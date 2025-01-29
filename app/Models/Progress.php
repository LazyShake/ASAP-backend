<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
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

    protected static function booted()
{
    static::deleting(function ($progress) {
        if ($progress->profession()->exists()) {
            throw new \Exception('Нельзя удалить запись прогресса, так как она связана с профессией.');
        }
    });
}


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
