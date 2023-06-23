<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scoring;
use App\Models\Criteria;
use App\Models\configuration_model;

class ScoringController extends Controller
{
    //
    public function results()
    {
        return view('judge-to-admin-results');
    }
    public function saveScores(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data['score'] as $candidateId => $scores) {
            foreach ($scores as $criteriaId => $score) {
                $scoringData = new Scoring();
                $scoringData->candidate_id = $candidateId;
                $scoringData->criteria_id = $criteriaId;
                $scoringData->score = $score;
                $scoringData->save();
            }
        }

        return view('judge-dashboard')->with('success', 'Scores saved successfully!');
    }

    public function viewScores()
    {
        $scores = Scoring::all();
        $candidates = configuration_model::pluck('candidate_name', 'id');
        $criteria = Criteria::pluck('criteria_name', 'id');

        return view('judge-to-admin-results', compact('scores', 'candidates', 'criteria'));
    }
}
