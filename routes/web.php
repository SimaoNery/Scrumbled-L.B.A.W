<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SprintController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController as ProfileController;
use App\Http\Controllers\TaskController;

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

// Home
Route::redirect('/', '/login');

Route::redirect('/admin', '/admin/login');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::get('/users/create', [AdminUserController::class, 'showCreate'])->name('admin.users.showCreate');
    Route::post('/users/create', [AdminUserController::class, 'createUser'])->name('admin.users.createUser');
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
        Route::get('/users', [AdminUserController::class, 'list'])->name('admin.users');
        Route::get('/users/{username}', [AdminUserController::class, 'show'])->name('admin.users.show');
        Route::get('/users/{username}/edit', [AdminUserController::class, 'showEdit'])->name('admin.users.showEdit');
        Route::post('/users/{username}/edit', [AdminUserController::class, 'edit'])->name('admin.users.edit');
        Route::post('/users/{username}/ban', [AdminUserController::class, 'ban'])->name('admin.users.ban');
        Route::post('/users/{username}/unban', [AdminUserController::class, 'unban'])->name('admin.users.unban');
    });
});

// Projects
Route::controller(ProjectController::class)->group(function () {
    Route::get('/projects', 'list')->name('projects');
    Route::get('/projects/new', 'create')->name('projects.create');
    Route::post('/projects/new', 'store')->name('projects.store');
    Route::get('/projects/{slug}', 'show')->name('projects.show');
    Route::get('/projects/{slug}/backlog', 'backlog')->name('projects.backlog');
    Route::get('/projects/{slug}/team', 'showTeam')->name('projects.team');
    Route::middleware(['auth', 'product.owner'])->group(function () {
        Route::get('/projects/{slug}/invite', 'showInviteForm')->name('projects.inviteForm');
        Route::post('/projects/{slug}/invite', 'inviteMember')->name('projects.invite.submit');
    });
    Route::get('/projects/{slug}/tasks', 'showTasks')->name('projects.tasks');
    //Route::get('/projects/{slug}/tasks/search', 'searchTasks')->name('projects.tasks.search');
});

// Authentication
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logout')->name('logout')->middleware(['auth:web']);
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
});

// Profile
Route::controller(ProfileController::class)->group(function () {
    Route::get('/profiles', 'list')->name('profiles');
    Route::get('/profiles/{username}', 'getProfile')->name('show.profile');
    Route::get('/profiles/{username}/edit', 'showEditProfileUI')->name('edit.profile.ui');
    Route::post('/profiles/{username}/edit', 'editProfile')->name('edit.profile');
});

// API
Route::controller(\App\Http\Controllers\Api\UserController::class)->group(function () {
    Route::get('/api/profiles/search', 'search');
});
Route::controller(\App\Http\Controllers\Api\TaskController::class)->group(function () {
    Route::get('/api/projects/{slug}/tasks/search', 'search');
});

//Sprints
Route::controller(SprintController::class)->group(function () {
    Route::get('/projects/{slug}/sprints', 'list')->name('sprints');
    Route::get('/projects/{slug}/sprints/new', 'create')->name('sprint.create');
    Route::post('/projects/{slug}/sprints/new', 'store')->name('sprint.store');
    Route::get('/sprints/{id}/edit', 'edit')->name('sprint.edit');
    Route::post('/sprints/{id}/edit', 'update')->name('sprint.update');
    Route::post('sprints/{id}/close', 'close')->name('sprint.close');
    Route::get('/sprints/{id}', 'show')->name('sprint.show');
});

//Tasks
Route::controller(TaskController::class)->group(function () {
    Route::post('/tasks/{id}/assign', 'assign')->name('tasks.assign');
    Route::get('projects/{slug}/tasks/new', 'showNew')->name('tasks.showNew');
    Route::post('projects/{slug}/tasks/new', 'createNew')->name('tasks.createNew');
    Route::get('projects/{slug}/tasks/{id}/edit', 'showEdit')->name('tasks.showEdit');
    Route::post('projects/{slug}/tasks/{id}/edit', 'editTask')->name('tasks.editTask');
    Route::post('/tasks/{id}/state', 'updateState')->name('tasks.updateState');
    Route::get('/tasks/{id}', 'show')->name('task.show');
});
