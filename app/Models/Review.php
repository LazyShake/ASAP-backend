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
        'profession_id',
        'owner',
        'status',
        'place_job',
        'job_before',
        'job_after',
    ];

   /* protected static function booted()
{
    static::deleting(function ($review) {
        if ($review->profession()->exists()) {
            // Формируем отформатированный JSON
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить отзыв, так как он связан с профессией.',
                'details' => [
                    'relation' => 'profession',  // Указываем, с какой сущностью связано
                    'related_model' => 'Profession',  // Указываем модель, с которой связана
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
        return $this->belongsTo(Profession::class, 'profession_id');
    }

    public static function getReviewsByProfession($professionId)
    {
        return self::where('profession_id', $professionId)->get();
    }
}
