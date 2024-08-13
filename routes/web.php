<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource("/employee", EmployeeController::class);
Route::resource('/projects', ProjectController::class);
Route::get('/projects/{id}/tasks', [ProjectController::class, 'getTasks'])->name('projects.tasks.api');
