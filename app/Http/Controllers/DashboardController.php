<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use Carbon\Carbon;
use App\Attendance;
use Hash;
use App\User;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disabled = (Attendance::checkAttendanceStatus()) ? true : false;
        
        return view('dashboard', ['disabled' => $disabled]);
    }

    public function store(Request $request)
    {
        if ( Auth::user()->attendances()->latest()->first()->time_out != NULL ) {
            
            Attendance::create([
                'user_id' => auth()->id(),
                'time_in' => strtotime(Carbon::now())
            ]);

            Session::flash('message', 'Time In: ' . Carbon::now()->format('h:i A, F d, Y'));
        }
        
        return back();
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::checkAttendanceStatus();

        $attendance->time_out = strtotime(Carbon::now());
        $attendance->update();

        Session::flash('message', 'Time Out: ' . Carbon::now()->format('h:i A, F d, Y'));
        return back();
    }

    public function settings(User $user)
    {
        return view('settings', [
            'disabled' => (Attendance::checkAttendanceStatus()) ? true : false,
        ]);
    }

    public function changePassword(Request $request)
    {

        // Validate data
        $validatedData = $request->validate([
            'current_password' => 'required|min:6',
            'new_password' => 'required|string|min:6|confirmed'
        ]);
        

        if (!(Hash::check($request->current_password, Auth::user()->password))) {
        
            // The password matches

            return redirect()->back()->with('error', 'Your current password does not match with the password you provided. Please try again.');
        }

        if(strcmp($request->current_password, $request->new_password) == 0) {

            // Current password and the new password is the same

            return redirect()->back()->with('error', 'New Password cannot be the same as your current password. Please choose a different password.');
        }        

        // Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }
}
