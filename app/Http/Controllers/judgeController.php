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
    $judges = $request->session()->get('judge');
    if (!$judges) {
        return view('/judge-login');
    }   
    return view('judge-dashboard', ['judge' => $judges]);
}

public function judgeLogin(Request $request)
{
    $judges = $request->session()->get('judge');
    if(!$judges) {
        return view('/judge-login');
    }
    return redirect()->route('judgeDash',['judge' => $judges]);
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

public function judgeLogout(Request $request)
{
    Session::forget('user');
    return redirect()->route('judge-user');
}

}
