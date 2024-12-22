<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $table = 'career';

    // Первичный ключ
    protected $primaryKey = 'id_career';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'name',
        'price',
        'vacancy',
        'images_vacancy',
    ];

    public function profession()
    {
        return $this->belongsTo(Profession::class);
    }

    // Указать, что timestamps присутствуют
    public $timestamps = true;
}
