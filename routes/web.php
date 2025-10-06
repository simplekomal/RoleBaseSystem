<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CanCreateUser;
use App\Http\Middleware\CheckUserLogin;
use GuzzleHttp\Middleware;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');
Route::redirect('/','/login');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/profile', [LoginController::class, 'profile'])->name('profile.show')->middleware(CheckUserLogin::class);

Route::get('/dashbord', function () {   
    return view('dashboard');
})->middleware(CheckUserLogin::class); 



Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');

Route::get('/home',function(){
    return view('home');
})->middleware(CheckUserLogin::class);

Route::get('/about',function(){
    return view('about');
})->middleware(CheckUserLogin::class);


Route::get('/admin/users/edit/{id}', [AdminController::class, 'edit'])->name('admin.users.edit');


Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.edit');
Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('admin.update');



Route::middleware('can:canShowRoleOptions')->group(function () {
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

});



 // Add User
 Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.create')->middleware('can:canCreateUser');
    Route::post('/admin/users/store', [AdminController::class, 'store'])->name('admin.store');


    Route::get('/admin/users/delete/{id}', [AdminController::class, 'destroy'])
    ->name('admin.users.delete')
    ->middleware('can:canDeleteUser');