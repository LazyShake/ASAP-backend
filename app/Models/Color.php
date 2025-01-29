<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    use HasFactory;

    protected $table = 'color';

    // Первичный ключ
    protected $primaryKey = 'id_color';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'name',
    ];

    public function professions()
    {
        return $this->hasMany(Profession::class, 'id_color', 'id_color');
    }

    // Метод для получения профессий, использующих данный цвет
    public function getProfessionsUsingColor()
    {
        return $this->professions()->get();
    }

    // Запрещаем удаление, если цвет используется в профессиях
    protected static function booted()
{
    static::deleting(function ($color) {
        // Получаем все профессии, использующие данный цвет
        $professionsUsingColor = $color->getProfessionsUsingColor();

        if ($professionsUsingColor->isNotEmpty()) {
            $professionNames = $professionsUsingColor->pluck('name_profession')->implode(', ');
            
            // Формируем массив для JSON-ответа
            $response = [
                'error' => true,
                'message' => 'Невозможно удалить цвет, так как он используется в следующих профессиях: ' . $professionNames,
                'details' => $professionsUsingColor->pluck('name_profession') // Возвращаем список профессий, использующих цвет
            ];

            // Выбрасываем исключение с отформатированным JSON
            throw new \Exception(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
    });
}

}
