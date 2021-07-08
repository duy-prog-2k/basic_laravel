<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function(){
    echo "This is homepage";
});

// Route::get('/about', function(){
//     return view('about');
// })->middleware('check'); // Ap dung middleware check /about?check= n
Route::get('/about', function(){
    return view('about');
});
Route::get('contact', [ContactController::class, 'index'])->name('con');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    $users = DB::table('users')->get();
    return view('dashboard',compact('users'));
})->name('dashboard');

// Category Controller
Route::get('/category/all', [CategoryController::class, 'index'])->name('all.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/soft-delete/category/{id}', [CategoryController::class, 'softDelete']);
Route::get('/soft-delete/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/soft-delete/category/delete/{id}', [CategoryController::class, 'delete']);
// Insert Category
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
