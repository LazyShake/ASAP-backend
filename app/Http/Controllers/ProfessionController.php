<?php

namespace App\Http\Controllers;

use App\Http\Resources\{ProfessionResource, ReferalResource, TariffResource, TrackerResource};
use Illuminate\Http\Request;
use App\Models\{Profession, Referal, Tracker, Tariff};

class ProfessionController extends Controller
{
    public function index()
    {
        $professions = Profession::with([
            'career',
            'typeProfession',
            'color',
            'skills',
            'mentors',
            'reviews',
            'progress',
            'articles',
        ])->paginate(10);

        return ProfessionResource::collection($professions);
    }

    public function show(int $id)
    {
        $profession = Profession::with([
            'career',
            'typeProfession',
            'color',
            'skills',
            'mentors',
            'reviews',
            'progress',
            'articles',
        ])->findOrFail($id);

        $trackers = Tracker::all();
        $referals = Referal::all();
        $tariffs = Tariff::all();

        return response()->json([
            'profession' => new ProfessionResource($profession),
            'trackers' => TrackerResource::collection($trackers),
            'referals' => ReferalResource::collection($referals),
            'tariffs' => TariffResource::collection($tariffs),
        ]);
    }
}
