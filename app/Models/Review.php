<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_review';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'reviews';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'text',
        'picture',
        'video',
        'profession',
        'owner',
    ];

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;

    // Отношение с профессией (обратная связь)
    public function profession()
    {
        return $this->belongsTo(Profession::class, 'profession');
    }

    public static function getReviewsByProfession($professionId)
    {
        return self::where('id_profession', $professionId)->get();
    }
}
