<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Profession extends Model
{
    use HasFactory;

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

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
