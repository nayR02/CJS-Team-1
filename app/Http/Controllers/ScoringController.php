<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scoring;
use App\Models\Criteria;
use App\Models\configuration_model;


class ScoringController extends Controller
{
    //
    // Assuming you have a model for your tabulation table, let's call it "Score".

    // Inside your controller method or route handler:
    public function saveScores(Request $request)
    {
        // Retrieve the submitted form data
        $formInput = $request->all();
    
        // Iterate over the submitted form data
        foreach ($formInput as $key => $data) {
            if (is_array($data) && strpos($key, 'score') === 0) {
                // Extract the candidate number and candidate name from the key
                $candidateNumber = $data['candidate_number'];
                $candidateName = $data['candidate_name'];
    
                // Find the candidate based on the candidate number
                $candidate = configuration_model::where('candidate_number', $candidateNumber)->first();
    
                // Iterate over the scores data
                foreach ($data['score'] as $criteriaId => $score) {
                    // Find the criteria based on the criteria ID
                    $criteria = Criteria::find($criteriaId);
    
                    // Create or update the scoring record
                    $scoring = Scoring::updateOrCreate(
                        ['candidate_id' => $candidate->id, 'criteria_id' => $criteria->id],
                        ['score' => $score]
                    );
    
                    // Associate the scoring record with the candidate and criteria
                    $scoring->candidate()->associate($candidate);
                    $scoring->criteria()->associate($criteria);
    
                    $scoring->save();
                }
            }
        }
    
        return view('judge-dashboard')->with('success', 'Scores saved successfully.');
    }
    
}
