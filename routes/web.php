<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\odercontroller;
use App\Http\Controllers\productController;
use App\Http\Controllers\Admin\danhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\sanPhamController;
use App\Http\Middleware\checkRoleAdminMiddleware;

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



Route::get('/', function () {
    return view('welcome');
});

// Route::get('/home', function () {
//     return view('home');
// })->middleware('auth');

Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logOut'])->name('logout');
 Route::get('/admin',function(){
    return 'đây là trang admin';
 })->middleware('auth.admin');
 Route::middleware('auth')->group(function(){
     Route::get('/home', function () {
        return view('home');
    });
     Route::middleware('auth.admin')->group(function(){

         Route::get('/admin',function(){
             return 'đây là trang admin';
       });
     });
 });
// Route ADMIN
Route::middleware(['auth','auth.admin'])->prefix('admins')
->as('admins.')
->group(function(){
    Route::get('/dashboard', function(){
return view('admins.dashboard');
    });
    Route::prefix('danhmucs')
    ->as('danhmucs.')
->group(function (){
    Route::get('/',[danhMucController::class,'index'] )->name('index');
    Route::get('/create',[danhMucController::class,'create'] )->name('create');
    Route::post('/store',[danhMucController::class,'store'] )->name('store');

    Route::get('/show/{id}',[danhMucController::class,'show'])->name('show');

    Route::get('{id}/edit',[danhMucController::class,'edit'])->name('edit');
    Route::put('{id}/update',[danhMucController::class,'update'])->name('update');

    Route::delete('{id}/destroy',[danhMucController::class,'destroy'])->name('destroy');

});
Route::prefix('sanpham')
    ->as('sanpham.')
->group(function (){
    Route::get('/',[sanPhamController::class,'index'] )->name('index');
    Route::get('/create',[sanPhamController::class,'create'] )->name('create');
    Route::post('/store',[sanPhamController::class,'store'] )->name('store');

    Route::get('/show/{id}',[sanPhamController::class,'show'])->name('show');

    Route::get('{id}/edit',[sanPhamController::class,'edit'])->name('edit');
    Route::put('{id}/update',[sanPhamController::class,'update'])->name('update');

    Route::delete('{id}/destroy',[sanPhamController::class,'destroy'])->name('destroy');
});
//Auth::routes();
Route::prefix('donhangs')
    ->as('donhangs.')
->group(function (){
    Route::get('/',[DonHangController::class,'index'] )->name('index');


    Route::get('/show/{id}',[DonHangController::class,'show'])->name('show');

    Route::get('{id}/edit',[DonHangController::class,'edit'])->name('edit');
    Route::put('{id}/update',[DonHangController::class,'update'])->name('update');

    Route::delete('{id}/destroy',[DonHangController::class,'destroy'])->name('destroy');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::get('/product/detail/{id}',[productController::class,'detailSanPham'])->name('products.detail');
Route::get('/list-cart',[cartController::class,'listCart'])->name('cart.list');
Route::post('/add-to-cart',[cartController::class,'addCart'])->name('cart.add');
Route::post('/update-cart',[cartController::class,'updateCart'])->name('cart.update');

// web.php (Route file)
Route::post('/clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::middleware('auth')->prefix('donhangs')
->as('donhangs.')
->group(function (){
Route::get('/',[odercontroller::class,'index'] )->name('index');
Route::get('/create',[odercontroller::class,'create'] )->name('create');
Route::post('/store',[odercontroller::class,'store'] )->name('store');

Route::get('/show/{id}',[odercontroller::class,'show'])->name('show');
Route::put('{id}/update',[odercontroller::class,'update'])->name('update');

Route::delete('{id}/destroy',[odercontroller::class,'destroy'])->name('destroy');

});

