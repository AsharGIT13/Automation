<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\supplier;
use App\Http\Controllers\Supplier_Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route::get('/', function () {
    //return view('index');
//});

Route::get('/',[Authcontroller::class,'Authentication'])->name('Authentication');
Route::get('/home',[supplier::class,'index'])->name('homepage');
Route::post('/supplier_registration',[supplier::class,'supplier_register'])->name('supplier_registration');
Route::get('/register_success',[supplier::class,'registration_success'])->name('success');
Route::get('/register_failure',[supplier::class,'registration_fail'])->name('failure');
Route::post('/adminpanel/userlogin',[Authcontroller::class,'userlogin'])->name('userlogin');

Route::middleware('role')->group(function () {
    Route::get('/suppliers',[Supplier_Controller::class,'fetch_suppplier'])->name('supplier.list');
    Route::post('/suppliers/approve',[Supplier_Controller::class,'approve'])->name('supplier.approve');
    Route::post('/suppliers/denied',[Supplier_Controller::class,'denied'])->name('supplier.denied');
    Route::get('/adminpanel/logout',[Authcontroller::class,'logout'])->name('logout');
    Route::get('/adminpanel',[Admincontroller::class,'Homepage'])->name('dashboard');
    Route::get('/adminpanel/supplier',[Admincontroller::class,'suppliers'])->name('supplier_list');
});