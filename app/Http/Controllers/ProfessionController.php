<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Referal;
use App\Http\Resources\ProfessionResource;
use App\Http\Resources\ReferalResource;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Возвращает список профессий с пагинацией.
     */
    public function index()
    {
        return ProfessionResource::collection(
            Profession::with([
                'career',
                'typeProfession',
                'color',
                'skills',
                'mentors',
                'reviews',
                'progress',
                'articles',
                'tariffs'
            ])->paginate(10)
        );
    }

    /**
     * Возвращает данные о конкретной профессии и связанных сущностях.
     *
     * @param int $id
     * @return array
     */
    public function show(int $id)
    {
        $profession = Profession::with([
            'career',
            'typeProfession',
            'color',
            'skills',
            'mentors',
            'trackers',
            'reviews',
            'progress',
            'articles',
            'tariffs'
        ])->findOrFail($id);

        $referals = Referal::all();

        return [
            'profession' => new ProfessionResource($profession),
            'referals' => ReferalResource::collection($referals),
        ];
    }
}
