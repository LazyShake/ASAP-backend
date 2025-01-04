<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstImage extends Model
{
    use HasFactory;

    protected $table = 'first_images';
    protected $primaryKey = 'id_first_image';

    protected $fillable = [
        'image',
    ];
}
