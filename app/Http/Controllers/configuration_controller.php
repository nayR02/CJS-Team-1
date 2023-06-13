<?php

namespace App\Http\Controllers;

use App\Models\judgemodel;
use Illuminate\Http\Request;
use App\Models\configuration_model;
use Illuminate\Support\Str;
use App\Models\Configuration;



class configuration_controller extends Controller
{

    public function categories()
    {
        return view('categories');
    }

    //  -- Create
    public function save(Request $request)
    {
        $cnumber = $request->input('candidate_number');
        $cname = $request->input('candidate_name');
        $municipality = $request->input('municipality');
        $age = $request->input('age');
        if ($request->hasFile('image')) {
            $profile = $request->file('image')->store('images', 'public');
        } else {
            // Handle the case when no image is uploaded
            $profile = "";
        }

        $information = new configuration_model;
        $information->candidate_number = $cnumber;
        $information->candidate_name = $cname;
        $information->municipality = $municipality;
        $information->age = $age;
        $information->profile = $profile;

        $information->save();

        return redirect('candidates');
    }

    // -- candidates Read
    public function get_info()
    {
        $getInfo = configuration_model::all();
        return view('candidates', ['infoList' => $getInfo]);
    }
    // judge Read
    public function judgeRead()
    {
        $judge = judgemodel::all();
        return view('judges', ['judges' => $judge]);
    }


    // -- candidates Delete
    public function delete_info($id)
    {
        $delete_info = configuration_model::find($id);
        $delete_info->delete();
        return redirect('candidates')->with('message', "Candidate's Data Deleted");
    }
    public function delete_judge($id)
    {
        $delete_judge = judgemodel::find($id);
        $delete_judge->delete();
        return redirect('judges')->with('message', "Jugde's Data Deleted");
    }
    // --- ++++++++++++++++++++++++++++++++++++ ----------------------------
    public function showForm()
    {
        $judges = judgemodel::all();
        return view('judge', compact('judges'));
    }

    // public function generate(Request $request)
    // {
    //     $request->validate([
    //         'judge_name' => 'required',
    //     ]);

    //     $judgename = $request->input('judge_name');
    //     $username = $this->generateUsername($judgename);
    //     $password = $this->generatePassword();

    //     $judgeList = new judgemodel();
    //     $judgeList->judge_name = $judgename;
    //     $judgeList->username = $username;
    //     $judgeList->password = ($password);
    //     $judgeList->save();

    //     $judges = judgemodel::all();
    //     return view('judges', compact('judges'));
    // }



    public function generate(Request $request)
    {
        $request->validate([
            'judge_name' => 'required',
        ]);

        $judgename = $request->input('judge_name');
        $username = $this->generateUsername($judgename);
        $password = $this->generatePassword();

        $judge = new judgemodel();
        $judge->judge_name = $judgename;
        $judge->username = $username;
        $judge->password = ($password);
        $judge->save();

        $judges = judgemodel::all();
        return view('judges', ['judges' => $judges]);
    }


    private function generateUsername($judgename)
    {
        $prefix = 'JUDGE-';
        $words = explode(' ', $judgename);
        $firstWord = isset($words[0]) ? ucfirst(strtolower($words[0])) : '';
        $username = $prefix . $firstWord;


        while (judgemodel::where('username', $username)->exists()) {
            $randomNumber = Str::random(5);
            $username = $prefix . $randomNumber;
        }

        return $username;
    }
    private function generatePassword($length = 6)
    {
        $password = '';
        for ($i = 0; $i < 3; $i++) {
            $password .= chr(rand(65, 90));
        }
        for ($i = 0; $i < 3; $i++) {
            $password .= rand(0, 9);
        }
        return $password;
    }
    // ========================


  
    //  --------------------------------------------------------------------







    
}
