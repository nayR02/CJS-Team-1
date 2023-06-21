<?php

namespace App\Http\Controllers;
use App\Models\AdminModel;
use App\Models\judgemodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class judgeController extends Controller
{
    
    public function dashboard(Request $request)
{
    $user = $request->session()->get('judge');
    if (!$user) {
        return view('/judge-login');
    }   
    return view('judge-dashboard', ['judge' => $user]);
}

public function judgeLogin(Request $request)
{
    $user = $request->session()->get('judge');
    if(!$user) {
        return view('/judge-login');
    }
    return redirect()->route('judgeDash',['judge' => $user]);
}

public function judgeLog(Request $request)
{
    $username = $request->input('username');
    $password = $request->input('password');

    $judge = judgemodel::where('username', $username)->first();

    if ($judge && $judge->password === $password) {
        $request->session()->put('judge', $judge);
        return redirect()->route('judgeDash');
    } else {
        // Invalid credentials, show error message
        return redirect()->back()->withErrors(['error' => 'Invalid login credentials']);
    }
}

public function judgeLogout()
{
    Session::forget('judge');
    return redirect()->route('judge-user');
}


}
