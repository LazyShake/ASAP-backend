<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_tariff';
    // Указываем таблицу, если имя модели отличается от имени таблицы
    protected $table = 'tariffs';

    // Указываем столбцы, которые могут быть массово присваиваемыми
    protected $fillable = [
        'name_tariff',
        'short_description',
        'price',
        'installment',
        'detailed_description',
    ];

    protected $casts = [
        'detailed_description' => 'array',
    ];
    

    // Указываем, что Laravel будет работать с временными метками created_at и updated_at
    public $timestamps = true;
}
