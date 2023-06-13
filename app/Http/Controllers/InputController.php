<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Session;
use App\Models\Rounds;
use Carbon\Carbon;

class InputController extends Controller
{

    public function storeInputs(Request $request)
    {
        $sdate = $request->input('start_date');
        $edate = $request->input('end_date');
        $ename = $request->input('event_name');
        $venue = $request->input('venue');

        $eventConfiguration = new Configuration;
        $eventConfiguration->start_date = $sdate;
        $eventConfiguration->end_date = $edate;
        $eventConfiguration->event_name = $ename;
        $eventConfiguration->venue = $venue;
        $eventConfiguration->save();

        $rounds = $request->input('rounds');

        foreach ($rounds as $round) {
            $dynamic = new Rounds;
            $dynamic->rounds = $round;
            $dynamic->configuration_id = $eventConfiguration->id;
            $dynamic->save();
        }

        return redirect('add_info')->with('event', 'Event added successfully.');
    }
    // public function dashboard(Request $request) {

        
    //     return view('/add_info', ['user' => $user]);
    // }
    public function read(Request $request)
    {   
        $user = $request->session()->get('user');
        if (!$user) {
            return view('/admin-login');
        }

        
        $eventConfigurations = Configuration::all();

        $rounds = Rounds::all();
        foreach ($eventConfigurations as $eventConfiguration) {
            $eventConfiguration->start_date = $eventConfiguration->start_date ? Carbon::parse($eventConfiguration->start_date)->format('F j, Y') : null;
            $eventConfiguration->end_date = $eventConfiguration->end_date ? Carbon::parse($eventConfiguration->end_date)->format('F j, Y') : null;
        }


        return view('add_info', compact('eventConfigurations'), compact('rounds'), ['user' => $user]);
    }


    public function delete_event($id)
    {
        $delete_event = Configuration::find($id);
        $delete_event->delete();

        $rounds = Rounds::where('configuration_id', $id)->get();
        foreach ($rounds as $round) {
            $round->delete();
        }

        return redirect('add_info')->with('delete-event', "Event data deleted");
    }

    // ---
    public function adminLogin(Request $request) {
        $user = $request->session()->get('user');
        if(!$user) {
            return view('/admin-login');
        }
        return view('/admin-login' , ['user' => $user]);
    }

    public function save(Request $request)
    {
        $username = $request->input()['username'];
        $password = $request->input()['password'];
        $user = AdminModel::where('username', $username)->first();
        if ($user && $user->password === $password) {
            $request->session()->put('user', $user);
            return redirect()->route('event.input');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid login credentials']);
        }
    }

    public function adminLogout() {
       Session::forget('user');

        return redirect()->route('admin-user');
    }
}
