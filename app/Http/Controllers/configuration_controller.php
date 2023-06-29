<?php

namespace App\Http\Controllers;

use App\Models\judgemodel;
use Illuminate\Http\Request;
use App\Models\configuration_model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class configuration_controller extends Controller
{

    public function categories()
    {
        return view('/categories/index');
    }

    //  -- Create
    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'candidate_number' => 'required|numeric|unique:candidate_configurations',
            'candidate_name' => 'required|string',
            'municipality' => 'required|string',
            'age' => 'required|integer', 
            'avatar' => 'required|image', 
        ]);
    
        $cnumber = $validatedData['candidate_number'];
        $cname = ucwords($validatedData['candidate_name']);
        $municipality = ucwords($validatedData['municipality']);
        $age = $validatedData['age'];

        $file = $request->file('avatar');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::disk('public')->put($filename, file_get_contents($file));

        $information = new configuration_model; // Replace with your configuration model name

        $information->candidate_number = $cnumber;
        $information->candidate_name = $cname;
        $information->municipality = $municipality;
        $information->age = $age;
        $information->profile = $filename;
        
        
        $information->save();

        $sortedCandidates = configuration_model::orderBy('candidate_number')->get();
        return redirect('candidates');  

        $information->save();

        return redirect('candidates')->with('candidate', 'Candidate Information Added');
    }
    // -- candidates Read
    public function get_info(Request $request)
    {
        $user = $request->session()->get('user');
        $getInfo = configuration_model::all();
        if (!$user) {
            return view('/admin-login');
        }  
        return view('candidates', ['infoList' => $getInfo],['user' => $user]);
    }
    // judge Read
    public function judgeRead(Request $request)
    {
        $user = $request->session()->get('user');
        $judge = judgemodel::all();
        if (!$user) {
            return view('/admin-login');
        }   
        return view('judges', ['judges' => $judge],['user' => $user]);
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
        return redirect('judges')->with('deleted', "Jugde's Data Deleted");
    }
    // --- ++++++++++++++++++++++++++++++++++++ ----------------------------
    public function showForm()
    {
        $judges = judgemodel::all();
        return view('judge', compact('judges'));
    }

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
   








}
