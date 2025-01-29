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
        'price',
        'vacancy',
        'images_vacancy',
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
    protected static function booted()
    {
        static::deleting(function ($career) {
            // Получаем все профессии, использующие эту карьеру
            $professionsUsingCareer = $career->getProfessionsUsingCareer();

            if ($professionsUsingCareer->isNotEmpty()) {
                $professionNames = $professionsUsingCareer->pluck('name_profession')->implode(', ');
                throw new \Exception('Невозможно удалить карьеру, так как она используется в следующих профессиях: ' . $professionNames);
            }
        });
    }

    // Указать, что timestamps присутствуют
    public $timestamps = true;
}
