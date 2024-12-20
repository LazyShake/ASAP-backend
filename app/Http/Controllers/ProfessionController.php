<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Program;
use App\Models\Mentor;
use App\Models\Article;
use App\Models\Progress;
use App\Models\Review;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    public function show($id)
    {
        $profession = Profession::findOrFail($id);

        $mentors = Mentor::getMentors($id);

        $trackers = Mentor::getTrackers($id);

        $skills = $profession->getSkillsList();

        $programs = Program::where('id_profession', $id)->orderBy('number_module')->get();

        $articles = Article::where('id_profession', $id)->orderBy('created_at', 'desc')->take(2)->get();

        $progress = Progress::getProgressByProfession($id);

        $training_plan = $profession->getTrainingPlan();

        $reviews = Progress::getReviewsByProfession($id);

        $tariff = $profession->getTariff();
        
        $professions = Profession::all();

        return view('profession', compact('profession', 'mentors', 'trackers', 'skills', 'programs', 'articles', 'progress', 'training_plan', 'reviews', 'tariff', 'professions'));
    }
}
