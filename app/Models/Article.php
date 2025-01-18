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
        'short_text',
        'content',
        'picture',
        'type_id',
        'id_profession',
        'filter_id',
        'link',
        'owner_name',
        'owner_description',
        'owner_picture',
        'seo_title', // SEO заголовок
        'seo_description', // SEO описание
        'seo_keywords', // SEO ключевые слова
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id_type');
    }

    public function profession()
    {
        return $this->belongsTo(Profession::class, 'id_profession', 'id_profession');
    }

    public function filter()
    {
        return $this->belongsTo(Filter::class, 'filter_id', 'filter_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'article_tag', 'article_id', 'tag_id');
    }

    public static function getArticlesByProfession($professionId)
    {
        return self::where('id_profession', $professionId)->get();
    }

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;
}
