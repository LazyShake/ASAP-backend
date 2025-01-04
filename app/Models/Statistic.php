<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $table = 'statistics';
    protected $primaryKey = 'id_statistics';

    protected $fillable = [
        'name_statistics',
        'quantity',
    ];
}
