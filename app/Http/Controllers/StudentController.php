<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profiles(Request $request)
    {
        $student = Student::where('username', Auth::user()->username)->first();
        return response()->json($student);
    }

    public function updateLastLogin(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        $student->last_login = now();
        $student->save();
    }

    public function updateAnswer(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required',
            'answer' => 'required',
            'min' => 'required',
            'sec' => 'required',
        ]);

        $student = Student::find(Auth::user()->id);
        $student->updateAnswer($validated['id'], $validated['answer'], $validated['min'], $validated['sec']);
    }

    public function getNotifications(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        $notifications = $student->getNotifications();
        return response()->json($notifications);
    }

    public function sendChat(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $student = Student::find(Auth::user()->id);
        $student->sendChat($validated['content']);
    }

    public function updateProfiles(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
        ]);

        $student = Student::find(Auth::user()->id);
        $student->updateProfiles($validated);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showDashboard(Request $request)
    {
        $student = Student::find(Auth::user()->id);
        $dashboardInfo = $student->getDashboardInfo();
        return view('student.dashboard', ['dashboardInfo' => $dashboardInfo]);
    }
}
