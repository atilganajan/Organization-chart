<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,"index"])->name("home");


route::prefix('department')->name('department.')->group(function (){
    Route::get('/', [DepartmentController::class, 'index'])->name('index');
    Route::get('/list', [DepartmentController::class, 'list'])->name('list');
    Route::post('/create', [DepartmentController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit');
    Route::put('/update', [DepartmentController::class, 'update'])->name('update');
    Route::delete('/delete', [DepartmentController::class, 'delete'])->name('delete');
});

route::prefix('person')->name('person.')->group(function (){
    Route::get('/', [PersonController::class, 'index'])->name('index');
    Route::get('/list', [PersonController::class, 'list'])->name('list');
    Route::post('/create', [PersonController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [PersonController::class, 'edit'])->name('edit');
    Route::put('/update', [PersonController::class, 'update'])->name('update');
    Route::delete('/delete', [PersonController::class, 'delete'])->name('delete');
});



