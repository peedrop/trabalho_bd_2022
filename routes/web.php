<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlunoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\TurmaController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\FaculdadeController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\DisciplinaController;
use App\Http\Controllers\EquipamentoController;
use App\Http\Controllers\DepartamentoController;

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

Route::middleware(['auth'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('alunos', AlunoController::class);
        Route::resource('cursos', CursoController::class);
        Route::resource('departamentos', DepartamentoController::class);
        Route::resource('disciplinas', DisciplinaController::class);
        Route::resource('equipamentos', EquipamentoController::class);
        Route::resource('faculdades', FaculdadeController::class);
        Route::resource('professors', ProfessorController::class);
        Route::resource('reservas', ReservaController::class);
        Route::resource('salas', SalaController::class);
        Route::resource('turmas', TurmaController::class);
        Route::resource('users', UserController::class);
    });
