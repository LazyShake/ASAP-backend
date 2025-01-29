<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Profession extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name_profession') // Генерация из поля title
            ->saveSlugsTo('slug');      // Сохранение в поле slug
    }

    // Указываем кастомное имя первичного ключа
    protected $primaryKey = 'id_profession';

    // Автоинкрементный ключ
    public $incrementing = true;

    // Тип ключа
    protected $keyType = 'int';

    // Таблица, связанная с моделью
    protected $table = 'professions';

    // Поля, доступные для массового заполнения
    protected $fillable = [
        'name_profession',
        'slug',
        'image',
        'price',
        'period',
        'start_of_training',
        'id_career',
        'id_color',
        'id_type',
        'place',
        'description',
        'miniimage',
        'skilltext',
        'SEO_key_words',
        'SEO_title',
        'SEO_description'
    ];

    protected static function booted()
    {
        static::creating(function ($profession) {
            if (empty($profession->slug)) {
                $profession->slug = Str::slug($profession->name_profession);
            }
        });

        static::deleting(function ($profession) {
            $relations = [
                'mentors' => 'Менторы',
                'articles' => 'Статьи',
                'programs' => 'Программы',
                'reviews' => 'Отзывы',
                'skills' => 'Навыки',
                'progress' => 'Прогресс',
            ];

            $usedIn = [];

            // Получаем связанные записи, которые используют эту профессию
            foreach ($relations as $relation => $name) {
                if ($profession->$relation()->exists()) {
                    // Формируем список, где используются записи профессии
                    $usedIn[] = $name;
                }
            }

            // Если есть связи, выбрасываем исключение с подробной информацией
            if (!empty($usedIn)) {
                $usedInList = implode(', ', $usedIn);
                throw new \Exception('Нельзя удалить профессию, так как она связана с: ' . $usedInList);
            }
        });
    }


    // Отношения
    public function career()
    {
        return $this->belongsTo(Career::class, 'id_career', 'id_career');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'id_color', 'id_color');
    }

    public function typeProfession()
    {
        return $this->belongsTo(TypeProfession::class, 'id_type', 'id');
    }

    public function progress()
    {
        return $this->hasMany(Progress::class, 'id_profession', 'id_profession');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'profession_skill','id_profession', 'id_skills');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'profession_id', 'id_profession');
    }

    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'id_profession', 'id_profession');
    }
    public function articles()
    {
        return $this->hasMany(Article::class, 'id_profession', 'id_profession');
    }
    public function programs()
    {
        return $this->hasMany(Program::class, 'id_profession', 'id_profession');
    }

}
