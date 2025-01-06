<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Http\Resources\ProfessionResource;
use App\Http\Resources\ReferalResource;
use App\Models\Referal;
/*use App\Models\Program;
use App\Models\Mentor;
use App\Models\Article;
use App\Models\Progress;
use App\Models\Review;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;*/

class ProfessionController extends Controller
{
    /*public function show($id)
    {
        $profession = Profession::findOrFail($id);

        $mentors = Mentor::getMentors($id);

        $trackers = Mentor::getTrackers($id);

        $skills = $profession->getSkillsList();

        $programs = Program::where('id_profession', $id)->orderBy('number_module')->get();

        $articles = Article::where('id_profession', $id)->orderBy('created_at', 'desc')->take(2)->get();

        $progress = Progress::getProgressByProfession($id);

        $training_plan = $profession->getTrainingPlan();

        $reviews = Review::getReviewsByProfession($id);

        $tariff = $profession->getTariff();
        
        $professions = Profession::all();

        $referal = Referal::all();

        return view('profession', compact('profession', 'mentors', 'trackers', 'skills', 'programs', 'articles', 'progress', 'training_plan', 'reviews', 'tariff', 'professions'));
    }*/

    public function index()
    {
        // Возвращает список профессий с их связями
        return ProfessionResource::collection(
            Profession::with(['color', 'skills', 'mentors', 'reviews', 'progress'])->get()
        );
    }

    public function show(int $profession)
    {
        
        $referals = Referal::all();
        $profession = Profession::find($profession);
        //dd(new ProfessionResource($profession->load(['career', 'typeProfession', 'color', 'skills', 'mentors', 'reviews', 'progress'])));

        return [
            'profession' => new ProfessionResource($profession->load(['career', 'typeProfession', 'color', 'skills', 'mentors', 'reviews', 'progress'])),
            'referals' => ReferalResource::collection($referals),
        ];
    }
}