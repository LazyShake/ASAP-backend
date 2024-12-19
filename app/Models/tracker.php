<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tracker extends Model
{
    use HasFactory;
    
    protected $table = 'trackers';

    // Первичный ключ
    protected $primaryKey = 'id_trackers';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'name_tracker',
        'picture',
        'description',
        'status',
    ];

    // Указать, что timestamps присутствуют
    public $timestamps = true;
}
