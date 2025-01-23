<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'trackers';
    protected $primaryKey = 'id_trackers';

    /**
     * Атрибуты, которые можно массово заполнять.
     */
    protected $fillable = [
        'name_tracker',
        'picture',
        'description',
    ];
}