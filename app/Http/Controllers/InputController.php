<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuration;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Session;
use App\Models\Rounds;
use App\Models\Categories;
use Carbon\Carbon;

class InputController extends Controller
{

    public function storeInputs(Request $request)
    {
        $date = $request->input('date');
        $stime = $request->input('start_time');
        $etime = $request->input('end_time');
        $ename = $request->input('event_name');
        $venue = $request->input('venue');

        $eventConfiguration = new Configuration;
        $eventConfiguration->date = $date;
        $eventConfiguration->start_time = $stime;
        $eventConfiguration->end_time = $etime;
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

        return redirect('add_info')->with([
            'event' => 'Event added successfully.'
        ]);
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
            $eventConfiguration->date = $eventConfiguration->date ? Carbon::parse($eventConfiguration->start_date)->format('F j, Y') : null;
        }


        return view('add_info', compact('eventConfigurations'), compact('rounds'), compact('user'));
    }


    public function delete_event($id)
    {
        $delete_event = Configuration::find($id);
        $delete_event->delete();

        $rounds = Rounds::where('configuration_id', $id)->get();
        foreach ($rounds as $round) {
            $round->delete();
        }
        $categories = Categories::where('rounds_id', $id)->get();
        foreach ($categories as $category) {
            $category->delete();
        }

        return redirect('add_info')->with('delete-event', "Event data deleted");
    }

    // ---
    public function adminLogin(Request $request) {
        $user = $request->session()->get('user');
        if(!$user) {
            return view('/admin-login');
        }
        return redirect()->route('read_add_info' , ['user' => $user]);
    }

    public function save(Request $request)
    {
        $username = $request->input()['username'];
        $password = $request->input()['password'];
        $user = AdminModel::where('username', $username)->first();
        if ($user && $user->password === $password) {
            $request->session()->put('user', $user);
            return redirect()->route('read_add_info');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid login credentials']);
        }
    }

    public function adminLogout() {
       Session::forget('user');

        return redirect()->route('admin-user');
    }
}
