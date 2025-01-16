<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingPlan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_training_plan';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'training_plans';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'image',
    ];


    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;
}
