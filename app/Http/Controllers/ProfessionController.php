<?php

namespace App\Http\Controllers;

use App\Http\Resources\{ProfessionResource, ReferalResource, TariffResource, TrackerResource, TrainingPlanResource};
use Illuminate\Http\Request;
use App\Models\{Profession, Referal, Tracker, Tariff, TrainingPlan};
use Illuminate\Support\Str;

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

        return ProfessionResource::collection($professions->isEmpty() ? [] : $professions);
    }

    public function show($slug)
    {
        $profession = Profession::where('slug', $slug)->first();

        if (!$profession) {
            return response()->json(['error' => 'Profession not found'], 404);
        }

        $profession->load([
            'career',
            'typeProfession',
            'color',
            'skills',
            'mentors',
            'reviews',
            'progress',
            'articles',
        ]);

        $trackers = Tracker::all();
        $referals = Referal::all();
        $tariffs = Tariff::all();
        $trainingPlan = TrainingPlan::first();

        return response()->json([
            'profession' => new ProfessionResource($profession),
            'trackers' => $trackers->isEmpty() ? [] : TrackerResource::collection($trackers),
            'referals' => $referals->isEmpty() ? null : new ReferalResource($referals->first()),
            'tariffs' => $tariffs->isEmpty() ? [] : TariffResource::collection($tariffs),
            'training_plan' => $trainingPlan ? new TrainingPlanResource($trainingPlan) : null,
        ]);
    }

    public function update(Request $request, Profession $profession)
    {
        $validated = $request->validate([
            'name_profession' => 'required|string|max:255',
        ]);

        $slug = $this->generateUniqueSlug(Profession::class, $validated['name_profession']);

        $profession->update([
            'name_profession' => $validated['name_profession'],
            'slug' => $slug,
        ]);

        return response()->json([
            'message' => 'Profession updated successfully',
            'profession' => new ProfessionResource($profession),
        ]);
    }

    private function generateUniqueSlug($model, $title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;

        $counter = 1;
        while ($model::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        return $slug;
    }
}
