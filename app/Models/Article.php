<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_article';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'articles';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'name_article',
        'text',
        'picture',
        'type',
    ];

    // Указываем связь с таблицей "types" (если связь с типами)
    public function type()
    {
        return $this->belongsTo(Type::class, 'type', 'id_type');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profession');
    }

    public static function getArticlesByProfession($professionId)
    {
        return self::where('id_profession', $professionId)->get();
    }

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;
}