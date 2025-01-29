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

    protected static function booted()
{
    static::deleting(function ($typeProfession) {
        // Получаем все профессии, использующие данный тип профессии
        $professionsUsingType = $typeProfession->getProfessionsUsingType();

        if ($professionsUsingType->isNotEmpty()) {
            $professionNames = $professionsUsingType->pluck('name_profession')->implode(', ');
            throw new \Exception('Невозможно удалить тип профессии, так как он используется в следующих профессиях: ' . $professionNames);
        }
    });
}


    public function professions()
{
    return $this->hasMany(Profession::class, 'id_type', 'id');
}

public function getProfessionsUsingType()
{
    return $this->professions()->get();
}


}
