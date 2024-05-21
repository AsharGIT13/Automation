<?php

use App\Http\Controllers\Admincontroller;
use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Category_Controller;
use App\Http\Controllers\supplier;
use App\Http\Controllers\Supplier_Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryContrller;
use App\Http\Controllers\UserController;
use App\Models\Subcategory;

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
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('role')->group(function () {
    Route::get('/suppliers',[Supplier_Controller::class,'fetch_suppplier'])->name('supplier.list');
    Route::post('/suppliers/approve',[Supplier_Controller::class,'approve'])->name('supplier.approve');
    Route::post('/suppliers/denied',[Supplier_Controller::class,'denied'])->name('supplier.denied');
    // Route::get('/adminpanel/logout',[Authcontroller::class,'logout'])->name('admin_logout');
    Route::get('/adminpanel',[Admincontroller::class,'Homepage'])->name('dashboard');
    Route::get('/adminpanel/supplier',[Admincontroller::class,'suppliers'])->name('supplier_list');
});

// Route::resource('menus', 'MenuController');
Route::get('/menu',[MenuController::class,'index'])->name('menus.menu_index');
Route::get('/create',[MenuController::class,'create'])->name('menus.create');
Route::post('/store',[MenuController::class,'store'])->name('menus.store');
Route::get('/edit',[MenuController::class,'edit'])->name('menus.edit');
Route::put('/update',[MenuController::class,'update'])->name('menus.update');
Route::delete('/destroy',[MenuController::class,'destroy'])->name('menus.destroy');

Route::resource('menu-items', MenuItemController::class);

Route::get('/assign_menu_view',[MenuController::class,'assign_menu_view'])->name('assign_menu_view');
Route::post('/assign_menu_store',[MenuController::class,'assign_menu_store'])->name('assign_menu_store');
Route::get('/assigned-menus/{role}/edit', [MenuController::class, 'assign_menu_edit'])->name('assign_menu_edit');
Route::put('/assigned-menus/{role}', [MenuController::class, 'assign_menu_update'])->name('assign_menu_update');
Route::get('/get-assigned-menus/{role}', [MenuController::class, 'getAssignedMenus'])->name('get_assigned_menus');

//Category Routes

Route::get('/category',[Category_Controller::class,'index'])->name('category');
Route::post('/category_store',[Category_Controller::class,'store'])->name('category.store');
Route::get('/category/fetch', [Category_Controller::class,'fetch'])->name('category.fetch');
Route::post('/category/update/{id}', [Category_Controller::class,'update'])->name('category.update');
Route::delete('/category/destroy/{category}', [Category_Controller::class,'destroy'])->name('category.destroy');

//Brand Routes

Route::get('/brand',[BrandController::class,'index'])->name('brand');
Route::post('/brand_store',[BrandController::class,'store'])->name('brand.store');
Route::get('/brand/fetch', [BrandController::class,'fetch'])->name('brand.fetch');
Route::post('/brand/update/{id}', [BrandController::class,'update'])->name('brand.update');
Route::delete('/brand/destroy/{brand}', [BrandController::class,'destroy'])->name('brand.destroy');

//Subcategory Routes
Route::get('/subcat',[SubcategoryContrller::class,'index'])->name('subcategory');
Route::post('/subcat_store',[SubcategoryContrller::class,'store'])->name('subcategory.store');
Route::post('/subcat/update/{id}', [SubcategoryContrller::class,'update'])->name('subcategory.update');
Route::delete('/subcat/destroy/{subcat}', [SubcategoryContrller::class,'destroy'])->name('subcategory.destroy');
Route::get('/subcat/fetch', [SubcategoryContrller::class,'fetch'])->name('subcategory.fetch');

//Products Routes
Route::get('/product',[ProductController::class,'index'])->name('product');
Route::post('/get_product_list',[ProductController::class,'get_product_list'])->name('get_product_list');
Route::get('/create_product',[ProductController::class,'create'])->name('product.create');
Route::post('/store_product',[ProductController::class,'store_product'])->name('store_product');
Route::post('/get_subcat',[ProductController::class,'get_subcat'])->name('get_subcat');
Route::get('edit_product',[ProductController::class, 'edit_product'])->name('edit_product');
Route::get('delete_product',[ProductController::class, 'delete_product'])->name('delete_product');
Route::get('/download',[ProductController::class,  'download'])->name('download');
Route::post('/update_products',[ProductController::class,'update_products'])->name('update_products');



Route::resource('user', UserController::class);
Route::controller(UserController::class)->group(function () {
    Route::get('role_list', 'role_list')->name('role_list');
    Route::post('user_update', 'user_update')->name('user_update');
    Route::get('delete_user', 'destroy')->name('delete_user');
});
