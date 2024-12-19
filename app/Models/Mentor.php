<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    use HasFactory;

    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'mentors';

    protected $primaryKey = 'id_mentor';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'name_mentors',
        'picture',
        'description',
        'id_profession',
        'role',
    ];

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;

    // Отношение с профессией (обратная связь)
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profession');
    }

    // Получаем менторов по профессии
    public static function getMentorsByProfession($professionId)
    {
        return self::where('id_profession', $professionId)->get();
    }

    public static function getMentors($professionId)
    {
        return self::where('id_profession', $professionId)
                   ->where('role', 'mentor')
                   ->get();
    }

    // Получаем только трекеров (роль = 'tracker')
    public static function getTrackers($professionId)
    {
        return self::where('id_profession', $professionId)
                   ->where('role', 'tracker')
                   ->get();
    }
}
