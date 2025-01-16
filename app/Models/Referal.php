<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'referal';
    protected $primaryKey = 'id_referal';

    /**
     * Атрибуты, которые можно массово заполнять.
     */
    protected $fillable = [
        'price',
    ];
}
