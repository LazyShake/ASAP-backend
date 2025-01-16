<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    /**
     * Таблица, связанная с моделью.
     */
    protected $table = 'tags';
    protected $primaryKey = 'id_tag';

    /**
     * Атрибуты, которые можно массово заполнять.
     */
    protected $fillable = [
        'name_tag',
        'id_article',
    ];

    public function tags()
    {
        return $this->belongsTo(Article::class, 'id_article', 'id_article');
    }
}
