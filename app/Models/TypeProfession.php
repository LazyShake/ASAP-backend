<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProfession extends Model
{
    use HasFactory;

    protected $table = 'type_profession';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name_type',
    ];
}
