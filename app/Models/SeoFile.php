<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoFile extends Model
{
    use HasFactory;

    protected $table = 'seo_files';

    protected $fillable = [
        'file_name',
        'path',
    ];
}
