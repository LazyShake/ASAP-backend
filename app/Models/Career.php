<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    use HasFactory;
    protected $table = 'career';

    // Первичный ключ
    protected $primaryKey = 'id_career';

    // Поля, которые можно массово заполнять
    protected $fillable = [
        'name',
        'hh',
        'habr',
        'freelance',
        'start_vage',
        'one_year_vage',
        'three_year_vage',
    ];

    public function professions()
    {
        return $this->hasMany(Profession::class, 'id_career', 'id_career');
    }

    // Метод для получения профессий, использующих эту карьеру
    public function getProfessionsUsingCareer()
    {
        return $this->professions()->get();
    }

    // Запрещаем удаление, если карьера используется в профессиях
    /*protected static function booted()
    {
        static::deleting(function ($career) {
            // Получаем все профессии, использующие эту карьеру
            $professionsUsingCareer = $career->getProfessionsUsingCareer();
        
            if ($professionsUsingCareer->isNotEmpty()) {
                // Получаем имена профессий и объединяем их через запятую
                $professionNames = $professionsUsingCareer->pluck('name_profession')->implode(', ');
        
                // Генерируем отформатированный JSON
                $errorData = [
                    'error' => 'Произошла ошибка на сервере',
                    'message' => 'Невозможно удалить карьеру, так как она используется в следующих профессиях: ' . $professionNames,
                ];
        
                // Преобразуем в отформатированный JSON
                $formattedError = json_encode($errorData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                
                // Выбрасываем исключение с отформатированным JSON
                throw new \Exception($formattedError);
            }
        });
    }*/

    // Указать, что timestamps присутствуют
    public $timestamps = true;
}