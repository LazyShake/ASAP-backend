<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEOPage extends Model
{
    use HasFactory;

    protected $table = 'seo_pages'; // Указываем название таблицы

    protected $fillable = [
        'page_name',
        'SEO_title',
        'SEO_key_words',
        'SEO_description',
    ];
}
