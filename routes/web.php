<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\myController;
use App\Http\Controllers\userController;
use App\Http\Controllers\CrudController;

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get("home",[myController::class,'index']);

Route::post("user",[userController::class,'userLogin']);
// Route::get("login",[myController::class,'login']);

Route::view("login","Login");

// Route::view("noaccess","noaccess");
Route::view("profile","profile");


// Route::get("/login", function() {
//     if(session()->has('user')){
//         return redirect('profile');
//     }
//     return view('Login');
// });

// Route::get("/logout", function() {
//     if(session()->has('user')){
//         session()->pull('Login');
//     }
//     return view('Login');
// });
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('user','fireauth');

Route::get('/home/customer', [App\Http\Controllers\HomeController::class, 'customer'])->middleware('user','fireauth');

Route::get('/email/verify', [App\Http\Controllers\Auth\ResetController::class, 'verify_email'])->name('verify')->middleware('fireauth');

Route::post('login/{provider}/callback', 'Auth\LoginController@handleCallback');

Route::resource('/home/profile', App\Http\Controllers\Auth\ProfileController::class)->middleware('user','fireauth');

Route::resource('/password/reset', App\Http\Controllers\Auth\ResetController::class);

Route::resource('/img', App\Http\Controllers\ImageController::class);

// Route::get('/insert', function() {
//     $stuRef = app('firebase.firestore')->database()->collection('User')->newDocument();
//     $stuRef->set([
//        'firstname' => 'Seven',
//        'lastname' => 'Stac',
//        'age'    => 19
// ]);
// echo "<h1>".'inserted'."</h1>";

// });

// Route::get('/display', function(){
//   $student = app('firebase.firestore')->database()->collection('User')->document('71e0dd9cffe549f58024')->snapshot();
//   print_r('Student ID ='.$student->id());
//   print_r("<br>". 'Student Name = '.$student->data()['firstname']);
//   print_r("<br>".'Student Age = '.$student->data()['age']);
// });

// Route::get('/update', function(){
//   $student = app('firebase.firestore')->database()->collection('User')->document('71e0dd9cffe549f58024')
//  ->update([
//   ['path' => 'age', 'value' => '18']
//  ]);
//  echo "<h1>".'updated'."</h1>";
// });

// Route::get('/delete', function(){
//  app('firebase.firestore')->database()->collection('User')->document('71e0dd9cffe549f58024')->delete();
//  echo "<h1>".'deleted'."</h1>";
// });

// Route::resource('/crud', App\Http\Controllers\CrudController::class);

Route::get("index",[CrudController::class,'index']);
Route::get("insert",[CrudController::class,'insert']);
Route::post("insert",[CrudController::class,'store']);
Route::get("update",[CrudController::class,'update']);
Route::get("display",[CrudController::class,'view']);
Route::get("delete",[CrudController::class,'delete']);
Route::get("edit_contact/{id}",[CrudController::class,'update']);

Route::group(['middleware' => ['web']], function () {

    Route::any('auth/login', "Kkcodes\FirebaseAuth\Http\FirebaseAuthController@loginFirebase");

});
