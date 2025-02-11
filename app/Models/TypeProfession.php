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

    /*protected static function booted()
{
    static::deleting(function ($typeProfession) {
        // Получаем все профессии, использующие данный тип профессии
        $professionsUsingType = $typeProfession->getProfessionsUsingType();
    
        if ($professionsUsingType->isNotEmpty()) {
            // Формируем список названий профессий
            $professionNames = $professionsUsingType->pluck('name_profession')->implode(', ');
    
            // Формируем отформатированный JSON
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить тип профессии, так как он используется в следующих профессиях.',
                'details' => [
                    'relation' => 'professions',  // Указываем, с какой сущностью связан
                    'related_model' => 'Profession',  // Указываем модель, с которой связан
                    'professions' => $professionNames,  // Список профессий, использующих данный тип
                ]
            ];
    
            // Выбрасываем исключение с отформатированным JSON
            throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    });
    
}*/


    public function professions()
{
    return $this->hasMany(Profession::class, 'id_type', 'id');
}

public function getProfessionsUsingType()
{
    return $this->professions()->get();
}


}
