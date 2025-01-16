<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;

    protected $table = 'partners';
    protected $primaryKey = 'id_partners';

    protected $fillable = [
        'name_partners',
        'logo_partners',
    ];
}
