<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    use HasFactory;

    protected $table = 'filters';

    protected $primaryKey = 'filter_id';

    protected $fillable = [
        'name_filter',
    ];

    protected static function booted()
    {
        static::deleting(function ($filter) {
            // Получаем статьи, использующие данный фильтр
            $articlesUsingFilter = $filter->articles()->get();

            if ($articlesUsingFilter->isNotEmpty()) {
                // Формируем список названий статей
                $articleTitles = $articlesUsingFilter->pluck('name_article')->implode(', ');
                throw new \Exception('Нельзя удалить фильтр, так как он используется в следующих статьях: ' . $articleTitles);
            }
        });
    }


    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
