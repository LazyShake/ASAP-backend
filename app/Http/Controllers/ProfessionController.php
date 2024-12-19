<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Program;
use App\Models\Mentor;
use App\Models\Article;
use App\Models\Progress;
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
        
        $articles = Article::getArticlesByProfession($id);

        $progress = Progress::getProgressByProfession($id);

        return view('profession', compact('profession', 'mentors', 'trackers', 'skills', 'programs', 'articles', 'progress'));
    }
}
