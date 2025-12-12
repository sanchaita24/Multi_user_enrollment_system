<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectSystem;
use App\Http\Controllers\AdminSystem;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('login');
});
//AdminSystem controller work

Route::get('/admin_profile/{id}', [AdminSystem::class,'admin_profile_one']);
Route::get("/admin/admindasbord",[AdminSystem::class,'admin_profile'])->middleware('isAdmin');
Route::get("/admin/senrollment/{id}",[AdminSystem::class,'enrollment_form'])->middleware('isAdmin');
Route::post("/admin/enroll_student",[AdminSystem::class,'enrollment_insert'])->middleware('isAdmin');
Route::get("/admin/enrollment_info",[AdminSystem::class,'enrollment_getdata'])->middleware('isAdmin');
Route::get("/user_info/{id}",[AdminSystem::class,'user_show'])->middleware('isAdmin');
Route::get('/check_enrollment/{id}', [AdminSystem::class,'check_enroll']);

// Admin profile update,delete code 

// Route::get('/admin_profile/{id}', [AdminSystem::class, 'admin_profile_one'])->name('admin.profile');

// Show Edit Form
Route::get('/admin_edit/{id}', [AdminSystem::class, 'admin_edit'])->name('admin.edit');

// Update Admin
Route::post('/admin/update/{id}', [AdminSystem::class, 'admin_update'])->name('admin.update');

// Delete Admin
Route::get('/admin/delete/{id}', [AdminSystem::class, 'admin_delete'])->name('admin.delete');
//blocl,unblock
Route::get('/block/{id}', [AdminSystem::class, 'block_user'])->name('user.block');
Route::get('/unblock/{id}', [AdminSystem::class, 'unblock_user'])->name('user.unblock');



//projectSystem controller work
// signup   
Route::get("/register",[ProjectSystem::class,'signup_form']);
Route::post("/register_go",[ProjectSystem::class,'signup_post']);
Route::get("/login",[ProjectSystem::class,'login_page'])->name('login');
Route::post("/login_go",[ProjectSystem::class,'login_data']);
//logout
Route::get("/logout",[ProjectSystem::class,'logout_data'])->name('logout');

#user display
Route::get("/users",[ProjectSystem::class,'showUsers']);
// Route::get("/users_edit{id}",[ProjectSystem::class,'user_edit']);
Route::get('/user_edit/{id}', [ProjectSystem::class, 'user_edit'])->name('user_edit');
Route::post('/user_update/{id}', [ProjectSystem::class, 'user_update'])->name('user_update');
Route::get('/user_delete/{id}', [ProjectSystem::class, 'user_delete'])->name('user_delete');



//course route

Route::get("/course",[ProjectSystem::class,'course_form']);
Route::post("/course_data",[ProjectSystem::class,'course_data']);
Route::get("/course_list",[ProjectSystem::class,'course_show_noid']);
Route::get("/course_list/{id}",[ProjectSystem::class,'course_show']);
Route::get("/cedit{id}",[ProjectSystem::class,'course_edit']);
Route::post("/courseUpdate",[ProjectSystem::class,'course_update']);
Route::get("/cdelete{id}",[ProjectSystem::class,'course_delete']);

//student routes
Route::get('/student', [ProjectSystem::class, 'student_form_empty']);
Route::get("/student/{id}",[ProjectSystem::class,'student_form']);
Route::post("/student_data",[ProjectSystem::class,'student_data']);
Route::get("/student_list",[ProjectSystem::class,'student_show']);
Route::get("/sedit{id}",[ProjectSystem::class,'student_edit']);
Route::post("/studentUpdate",[ProjectSystem::class,'student_update']);
Route::get("/student{id}",[ProjectSystem::class,'student_delete']);

//enrollment say in projectSystem
Route::get("/enrollment_data/{id}/{course_id}",[ProjectSystem::class,'enrollment_submit']);