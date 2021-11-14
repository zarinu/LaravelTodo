<?php

use App\Http\Controllers\{UserController,BoardsController,HomeController};
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

Route::get('/test', function () {
    echo 'There is a test here!';
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/boards/{id}/edit', [BoardsController::class, 'edit'])->middleware(['auth'])->name('edit-board');
Route::post('/todos/{id}/update', [BoardsController::class, 'update'])->middleware(['auth'])->name('update');
Route::get('/boards/create', [BoardsController::class, 'create'])->middleware(['auth'])->name('create-board');
Route::post('/boards/add', [BoardsController::class, 'store'])->middleware(['auth'])->name('add');
Route::get('/boards/{id}', [BoardsController::class, 'show'])->middleware(['auth'])->name('show');
Route::post('/boards/{id}', [BoardsController::class, 'showp'])->middleware(['auth'])->name('showp');
Route::get('/boards/{id}/delete', [BoardsController::class, 'delete'])->middleware(['auth'])->name('delete');
Route::get('/todo', [BoardsController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::resource('users', UserController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
