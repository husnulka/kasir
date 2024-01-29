<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
 
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

/*Route::get('/', function () {
    return view('welcome');//C:\xampp\htdocs\kasir\resources\views\welcome.blade.php
});*/

//SesiController=LoginController
//hanya guest/yg belum login yg bisa masuk ke halaman login
Route::middleware(['guest'])->group(function(){
    Route::get('/', [LoginController::class, 'index'])->name('login');//ini halaman login
    Route::post('/', [LoginController::class, 'login']);
});

//kalo ada yg akses home akan diarahkan ke /user
//Route::get('/home', function(){  return redirect('/admin'); });

//tampilan awal setelah login
//userAkses adalah nama yg didaftarkan di app\http\kernel.php, cek juga LoginController.php
Route::middleware(['auth'])->group(function(){
    //Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    
    Route::get('/user', [UserController::class, 'index']);

    /*
    //mendaftarkan rute untuk role user, cek LoginController.php (bukan AdminController yaaaa)
    Route::get('/admin/operator', [AdminController::class, 'operator'])->middleware('userAkses:operator');
    Route::get('/admin/keuangan', [AdminController::class, 'keuangan'])->middleware('userAkses:keuangan');
    Route::get('/admin/marketing', [AdminController::class, 'marketing'])->middleware('userAkses:marketing');
    */

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::group(['middleware' => ['auth', 'userAkses:admin']], function(){
    //CRUD Data User
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);
});