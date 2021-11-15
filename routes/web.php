<?php

use App\Http\Controllers\{UserController,BoardsController,HomeController, TaskController};
use App\Models\Board;
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
Route::resources([
    'users' => UserController::class,
]);
Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/boards/{id}/edit', [BoardsController::class, 'edit'])->middleware(['auth'])->name('edit-board');
Route::post('/boards/{id}/update', [BoardsController::class, 'update'])->middleware(['auth'])->name('update');
Route::get('/boards/create', [BoardsController::class, 'create'])->middleware(['auth'])->name('create-board');
Route::post('/boards/add', [BoardsController::class, 'store'])->middleware(['auth'])->name('add');
Route::get('/boards/{id}', [BoardsController::class, 'show'])->middleware(['auth'])->name('show');
Route::get('/boards/{id}/delete', [BoardsController::class, 'delete'])->middleware(['auth'])->name('delete');
Route::get('/boards/{id}/collab', [BoardsController::class, 'collabGet'])->middleware(['auth'])->name('collab-board');
Route::post('/boards/{id}/collab', [BoardsController::class, 'collab'])->middleware(['auth'])->name('collab');
Route::get('/todo', [BoardsController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::post('/tasks/{bid}', [TaskController::class, 'store'])->middleware(['auth'])->name('addTask');
Route::put('/tasks/{bid}/{tid}', [TaskController::class, 'update'])->middleware(['auth'])->name('renameTask');
Route::patch('/tasks/{bid}/{tid}', [TaskController::class, 'edit'])->middleware(['auth'])->name('doneTask');
Route::delete('/tasks/{bid}/{tid}', [TaskController::class, 'destroy'])->middleware(['auth'])->name('deleteTask');