<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User; 
class AdminController extends Controller
{
   //todo: admin login form
   public function login_form()
   {
       return view('admin.login-form');
   }

   //todo: admin login functionality
   public function login_functionality(Request $request){
       $request->validate([
           'email'=>'required',
           'password'=>'required',
       ]);

       if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
           return redirect()->route('dashboard');
       }else{
           Session::flash('error-message','Invalid Email or Password');
           return back();
       }
   }

   public function dashboard()
   {
       return view('admin.dashboard');
   }


   //todo: admin logout functionality
   public function logout(){
       Auth::guard('admin')->logout();
       return redirect()->route('login.form');
   }

   public function roleSelection()
   {
       return view('roleselection'); // Assuming you have a view file named 'role-selection.blade.php'
   }
   public function admindashboard()
   {
       $admin = Auth::guard('admin')->user(); // Ensure you are using the correct guard
       if (!$admin) {
           abort(403, 'Unauthorized action.'); // Handle unauthorized access
       }
       return view('admin.dashboard', compact('admin'));
   }

   public function index()
   {
       $users = User::all(); // Fetch all users
    //    dd($users); // Dump the users variable to see its content
       return view('admin.usersview', compact('users'));
   }
   
}
