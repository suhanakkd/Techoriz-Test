<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
   
// });
Route::get('welcome', function () {
    return view('welcome'); // Assuming 'welcome.blade.php' exists in the 'resources/views' directory
})->name('welcome');

Route::get('/', function () {
    return redirect()->route('role.selection');
});

Route::get('login-form',[AdminController::class,'login_form'])->name('login.form');
Route::post('login-functionality',[AdminController::class,'login_functionality'])->name('login.functionality');
Route::group(['middleware'=>'admin'],function(){
    Route::get('logout',[AdminController::class,'logout'])->name('logout');
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
});

// Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('admin.dashboard');
Route::get('/admin/dashboard', [AdminController::class, 'admindashboard'])->name('dashboard');

Route::get('/users', [AdminController::class, 'index'])->name('users.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Auth::routes();
Route::get('role-selection', [AdminController::class, 'roleSelection'])->name('role.selection');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
