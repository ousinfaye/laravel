<?php

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/user/index', [App\Http\Controllers\UserController::class, 'index'])->name('listerUser');
Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('createUser');
Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('saveUser');
Route::get('/user/show', [App\Http\Controllers\UserController::class, 'show'])->name('identifiedUser');
Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('editUser');
Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('updateUser');
Route::get('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('deleteUser');
Route::get('/user/archive', [App\Http\Controllers\ArchiveUserController::class, 'index'])->name('listArchivedUser');
Route::get('/user/destroyer/{id}', [App\Http\Controllers\ArchiveUserController::class, 'destroyer'])->name('deleteArchivedUser');

Route::get('/projet/index', [App\Http\Controllers\ProjetController::class, 'index'])->name('listerProjet');
Route::get('/projet/create', [App\Http\Controllers\ProjetController::class, 'create'])->name('createProjet');
Route::post('/projet/store', [App\Http\Controllers\ProjetController::class, 'store'])->name('saveProjet');
Route::get('/projet/show', [App\Http\Controllers\ProjetController::class, 'show'])->name('identifiedProjet');
Route::get('/projet/edit/{id}', [App\Http\Controllers\ProjetController::class, 'edit'])->name('editProjet');
Route::post('/projet/update/{id}', [App\Http\Controllers\ProjetController::class, 'update'])->name('updateProjet');
Route::get('/projet/destroy/{id}', [App\Http\Controllers\ProjetController::class, 'destroy'])->name('deleteProjet');
Route::get('/projet/archive', [App\Http\Controllers\ProjetArchiveController::class, 'index'])->name('listArchivedProject');
Route::get('/projet/destroyer/{id}', [App\Http\Controllers\ProjetArchiveController::class, 'destroyer'])->name('deleteArchivedProject');
Route::get('/projet/mesprojets', [App\Http\Controllers\ProjetController::class, 'mesProjets'])->name('listerMesprojets');


Route::get('/equipe/index', [App\Http\Controllers\EquipeController::class, 'index'])->name('listerEquipe');
Route::get('/equipe/create', [App\Http\Controllers\EquipeController::class, 'create'])->name('createEquipe');
Route::post('/equipe/store', [App\Http\Controllers\EquipeController::class, 'store'])->name('saveEquipe');
Route::get('/equipe/show', [App\Http\Controllers\EquipeController::class, 'show'])->name('identifiedEquipe');
Route::get('/equipe/edit/{id}', [App\Http\Controllers\EquipeController::class, 'edit'])->name('editEquipe');
Route::post('/equipe/update/{id}', [App\Http\Controllers\EquipeController::class, 'update'])->name('updateEquipe');
Route::get('/equipe/destroy/{id}', [App\Http\Controllers\EquipeController::class, 'destroy'])->name('deleteEquipe');
Route::get('/equipe/deleteUserEquip/{id}', [App\Http\Controllers\EquipeController::class, 'deleteUserEquip'])->name('deleteUserEquip');
Route::post('/equipe/{equipeId}/add-user', [App\Http\Controllers\EquipeController::class, 'addUserToEquipe'])->name('addUserToEquipe');
Route::get('/equipe/monEquipe', [App\Http\Controllers\EquipeController::class, 'monEquipe'])->name('myEquip');

Route::get('/tache/index', [App\Http\Controllers\TacheController::class, 'index'])->name('listerTask');
Route::get('/tache/create', [App\Http\Controllers\TacheController::class, 'create'])->name('createTask');
Route::post('/tache/store', [App\Http\Controllers\TacheController::class, 'store'])->name('saveTask');
Route::get('/tache/show', [App\Http\Controllers\TacheController::class, 'show'])->name('identifiedTask');
Route::get('/tache/edit/{id}', [App\Http\Controllers\TacheController::class, 'edit'])->name('editTask');
Route::post('/tache/update/{id}', [App\Http\Controllers\TacheController::class, 'update'])->name('updateTask');
Route::get('/tache/destroy/{id}', [App\Http\Controllers\TacheController::class, 'destroy'])->name('deleteTask');
Route::get('/tache/archive', [App\Http\Controllers\TacheArchiveController::class, 'index'])->name('listArchivedTask');
Route::get('/tache/destroyer/{id}', [App\Http\Controllers\TacheArchiveController::class, 'destroyer'])->name('deleteArchivedTask');
Route::get('/tache/mesTaches', [App\Http\Controllers\TacheController::class, 'mesTaches'])->name('listMyTask');

Route::get('/notification/index', [\App\Http\Controllers\NotificationController::class, 'index'])->name('listNotification');
Route::get('/notification/create', [\App\Http\Controllers\NotificationController::class, 'create'])->name('createNotification');
Route::post('/notification/store', [\App\Http\Controllers\NotificationController::class, 'store'])->name('saveNotification');
Route::get('/notification/myNotif', [\App\Http\Controllers\NotificationController::class, 'myNotif'])->name('listMyNotification');
