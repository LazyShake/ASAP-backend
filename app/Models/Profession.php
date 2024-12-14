<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    use HasFactory;

    // Указываем, что таблица имеет кастомное имя первичного ключа
    protected $primaryKey = 'id_profession';

    // Если ключ не автозаполняемый (например, UUID), это нужно указать
    public $incrementing = true;

    // Тип данных для primaryKey
    protected $keyType = 'int';

    // Таблица, с которой связана модель
    protected $table = 'professions';

    // Поля, доступные для массового заполнения
    protected $fillable = [
        'name_profession',
        'price',
        'period',
        'start_of_training',
        'program',
        'id_mentors',
        'id_tariff',
        'id_article',
        'id_training_plan',
        'id_example_lesson',
        'id_reviews',
        'skills',
        'employment',
        'installment',
        'referral',
    ];

    // Пример отношений
    public function mentors()
    {
        return $this->hasMany(Mentor::class, 'id_profession', 'id_profession');
    }

    public function tariff()
    {
        return $this->belongsTo(Tariff::class, 'id_tariff');
    }

    public function article()
    {
        return $this->belongsTo(Article::class, 'id_article');
    }

    public function trainingPlan()
    {
        return $this->belongsTo(TrainingPlan::class, 'id_training_plan');
    }

    public function exampleLesson()
    {
        return $this->belongsTo(ExampleLesson::class, 'id_example_lesson');
    }

    public function reviews()
    {
        return $this->belongsTo(Review::class, 'id_reviews');
    }

    public function getSkillsList()
    {
        return explode(',', $this->skills);
    }

    public function getTrainingPlan()
    {
        return $this->trainingPlan;
    }

}
