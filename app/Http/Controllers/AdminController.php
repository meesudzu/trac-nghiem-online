&lt;?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // Assuming an Eloquent model for Admin exists
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function updateProfiles(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'gender' => 'required',
            'birthday' => 'required|date',
            'password' => 'required'
        ]);

        $admin = Admin::where('username', $validatedData['username'])->first();
        if ($admin) {
            $admin->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'gender' => $validatedData['gender'],
                'birthday' => $validatedData['birthday'],
                'password' => Hash::make($validatedData['password'])
            ]);
            return redirect()->back()->with('success', 'Profile updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Admin not found.');
        }
    }

    public function showAdminsPanel()
    {
        $admins = Admin::all();
        return view('admin.admins_panel', ['admins' => $admins]);
    }

    // Example method adapted from the original controller_admin.php
    public function getDashboardInfo()
    {
        $dashboardInfo = Admin::getDashboardInfo(); // Assuming this method is defined in the Admin model
        return view('admin.dashboard', ['dashboardInfo' => $dashboardInfo]);
    }

    // More methods adapted from controller_admin.php can be added here

}
