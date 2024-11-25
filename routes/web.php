<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PessoasController;
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

Route::get('/', [PessoasController::class, 'index']);

Route::post('/form', [PessoasController::class, "save"])->name('save');

Route::get('/form/new', [PessoasController::class, "index"])->name('new');

Route::get('/form/{pessoa}', [PessoasController::class, "edit"])->name('edit');

Route::put('/form/{pessoa}', [PessoasController::class, "update"])->name('update');

Route::get('/form/delete/{pessoa}', [PessoasController::class, "delete"])->name('delete');
