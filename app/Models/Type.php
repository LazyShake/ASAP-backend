<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'types';

    // Указываем столбцы, которые можно массово присваивать
    protected $fillable = [
        'name_type',
    ];

    // Указываем, что Laravel не должен ожидать поля timestamps, если их нет
    public $timestamps = true;
}