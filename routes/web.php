<?php

use App\Http\Controllers\{UserController,TodosController,HomeController};
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

Route::get('/todos/mine', [TodosController::class, 'byUserId'])->middleware(['auth'])->name('mine');
Route::get('/todos/{id}/edit', [TodosController::class, 'edit'])->middleware(['auth'])->name('edit-form');
Route::get('/todos/create', [TodosController::class, 'create'])->middleware(['auth'])->name('create-form');
Route::post('/todos/{id}/update', [TodosController::class, 'update'])->middleware(['auth'])->name('update');
Route::post('/todos/add', [TodosController::class, 'store'])->middleware(['auth'])->name('add');
Route::get('/todos/{id}', [TodosController::class, 'show'])->middleware(['auth'])->name('show');
Route::get('/todos/{id}/delete', [TodosController::class, 'delete'])->middleware(['auth'])->name('delete');
Route::get('/todo', [TodosController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::resource('users', UserController::class);

Route::get('/home', [HomeController::class, 'index'])->name('home');
