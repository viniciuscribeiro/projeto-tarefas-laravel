<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return redirect()->route('tasks.index');
    })->name('dashboard');

    Route::get('/tasks/trash', [TaskController::class, 'trash'])
        ->name('tasks.trash');

    Route::post('/tasks/{id}/restore', [TaskController::class, 'restore'])
        ->name('tasks.restore');

    Route::resource('tasks', TaskController::class);
});
