<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SalaController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AlunoController;
use App\Http\Controllers\Api\CursoController;
use App\Http\Controllers\Api\TurmaController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\FaculdadeController;
use App\Http\Controllers\Api\ProfessorController;
use App\Http\Controllers\Api\DisciplinaController;
use App\Http\Controllers\Api\AlunoCursosController;
use App\Http\Controllers\Api\CursoAlunosController;
use App\Http\Controllers\Api\EquipamentoController;
use App\Http\Controllers\Api\DepartamentoController;
use App\Http\Controllers\Api\SalaReservasController;
use App\Http\Controllers\Api\FaculdadeCursosController;
use App\Http\Controllers\Api\ProfessorTurmasController;
use App\Http\Controllers\Api\CursoDisciplinasController;
use App\Http\Controllers\Api\DisciplinaTurmasController;
use App\Http\Controllers\Api\SalaEquipamentosController;
use App\Http\Controllers\Api\DepartamentoProfessorsController;
use App\Http\Controllers\Api\DepartamentoDisciplinasController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('alunos', AlunoController::class);

        // Aluno Cursos
        Route::get('/alunos/{aluno}/cursos', [
            AlunoCursosController::class,
            'index',
        ])->name('alunos.cursos.index');
        Route::post('/alunos/{aluno}/cursos/{curso}', [
            AlunoCursosController::class,
            'store',
        ])->name('alunos.cursos.store');
        Route::delete('/alunos/{aluno}/cursos/{curso}', [
            AlunoCursosController::class,
            'destroy',
        ])->name('alunos.cursos.destroy');

        Route::apiResource('cursos', CursoController::class);

        // Curso Disciplinas
        Route::get('/cursos/{curso}/disciplinas', [
            CursoDisciplinasController::class,
            'index',
        ])->name('cursos.disciplinas.index');
        Route::post('/cursos/{curso}/disciplinas', [
            CursoDisciplinasController::class,
            'store',
        ])->name('cursos.disciplinas.store');

        // Curso Alunos
        Route::get('/cursos/{curso}/alunos', [
            CursoAlunosController::class,
            'index',
        ])->name('cursos.alunos.index');
        Route::post('/cursos/{curso}/alunos/{aluno}', [
            CursoAlunosController::class,
            'store',
        ])->name('cursos.alunos.store');
        Route::delete('/cursos/{curso}/alunos/{aluno}', [
            CursoAlunosController::class,
            'destroy',
        ])->name('cursos.alunos.destroy');

        Route::apiResource('departamentos', DepartamentoController::class);

        // Departamento Disciplinas
        Route::get('/departamentos/{departamento}/disciplinas', [
            DepartamentoDisciplinasController::class,
            'index',
        ])->name('departamentos.disciplinas.index');
        Route::post('/departamentos/{departamento}/disciplinas', [
            DepartamentoDisciplinasController::class,
            'store',
        ])->name('departamentos.disciplinas.store');

        // Departamento Professors
        Route::get('/departamentos/{departamento}/professors', [
            DepartamentoProfessorsController::class,
            'index',
        ])->name('departamentos.professors.index');
        Route::post('/departamentos/{departamento}/professors', [
            DepartamentoProfessorsController::class,
            'store',
        ])->name('departamentos.professors.store');

        Route::apiResource('disciplinas', DisciplinaController::class);

        // Disciplina Turmas
        Route::get('/disciplinas/{disciplina}/turmas', [
            DisciplinaTurmasController::class,
            'index',
        ])->name('disciplinas.turmas.index');
        Route::post('/disciplinas/{disciplina}/turmas', [
            DisciplinaTurmasController::class,
            'store',
        ])->name('disciplinas.turmas.store');

        Route::apiResource('equipamentos', EquipamentoController::class);

        Route::apiResource('faculdades', FaculdadeController::class);

        // Faculdade Cursos
        Route::get('/faculdades/{faculdade}/cursos', [
            FaculdadeCursosController::class,
            'index',
        ])->name('faculdades.cursos.index');
        Route::post('/faculdades/{faculdade}/cursos', [
            FaculdadeCursosController::class,
            'store',
        ])->name('faculdades.cursos.store');

        Route::apiResource('professors', ProfessorController::class);

        // Professor Turmas
        Route::get('/professors/{professor}/turmas', [
            ProfessorTurmasController::class,
            'index',
        ])->name('professors.turmas.index');
        Route::post('/professors/{professor}/turmas', [
            ProfessorTurmasController::class,
            'store',
        ])->name('professors.turmas.store');

        Route::apiResource('reservas', ReservaController::class);

        Route::apiResource('salas', SalaController::class);

        // Sala Reservas
        Route::get('/salas/{sala}/reservas', [
            SalaReservasController::class,
            'index',
        ])->name('salas.reservas.index');
        Route::post('/salas/{sala}/reservas', [
            SalaReservasController::class,
            'store',
        ])->name('salas.reservas.store');

        // Sala Equipamentos
        Route::get('/salas/{sala}/equipamentos', [
            SalaEquipamentosController::class,
            'index',
        ])->name('salas.equipamentos.index');
        Route::post('/salas/{sala}/equipamentos', [
            SalaEquipamentosController::class,
            'store',
        ])->name('salas.equipamentos.store');

        Route::apiResource('turmas', TurmaController::class);

        Route::apiResource('users', UserController::class);
    });
