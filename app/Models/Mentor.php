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
        'status',
        'workplace',
    ];

    /*protected static function booted()
{
    static::deleting(function ($mentor) {
        // Проверяем, связан ли ментор с профессией
        if ($mentor->profession()->exists()) {
            // Формируем массив для JSON-ответа
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить ментора, так как он связан с профессией.',
                'details' => [
                    'profession' => $mentor->profession->name_profession, // Название профессии
                ]
            ];
    
            // Выбрасываем исключение с отформатированным JSON
            throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    });
}*/


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

   
}
