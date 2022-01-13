<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\Admin\TaskController;

Route::middleware(['auth'])->group(function () {
    Route::get('/', [PageController::class, 'home'])->name('home');

    Route::get('/activities', function (){
        return view('admin.activities');
    });

    // Route::prefix('admin')->group(function () {

    // });
    // Admin Routes
        //Task Routes
    Route::get('tasks/taskboard', [PageController::class, 'taskboard'])->name('tasks.taskboard');
    Route::get('/tasks/overdue', [TaskController::class, 'overdue'])->name('tasks.overdue');
    Route::get('task/{id}/{taskfile}', [TaskController::class, 'downlaod'])->name('download.taskfile');
    Route::get('task/info/byid/{id}', [PageController::class, 'getTaskInfo']);
    Route::resource('tasks',  TaskController::class);
    Route::put('task/info/update', [TaskController::class, 'update'])->name('task.update');

        //Employee routes
    Route::get('employees/all', [PageController::class, 'employees'])->name('employees.all');
    Route::get('employees/departments', [PageController::class, 'departments'])->name('departments');

    // User Routes
        //Task Routes
    Route::get('task/active', [TaskController::class, 'active'])->name('tasks.active');
    Route::get('task/finished', [TaskController::class, 'finished'])->name('tasks.finished');
    Route::get('task/sector', [TaskController::class, 'sectorTasks'])->name('tasks.sector');
    Route::get('user/task/sector/overdue', [TaskController::class, 'sectorOverdue'])->name('sector.overdue');
    Route::get('/user/task/sector/completed', [TaskController::class, 'sectorCompleted'])->name('tasks.sector.completed');
    Route::get('user/task/{id}', [TaskController::class, 'userTask'])->name('user.task');
    Route::post('user/task/response', [ResponseController::class, 'store'])->name('response.store');
    Route::get('user/tasks/overdue/individual', [TaskController::class, 'overdueUser'])->name('user.overdue');
    Route::post('user/extend/deadline/request', [TaskController::class, 'extendDeadlineRequest'])->name('extend.deadline');
    Route::put('user/extend/deadline/request/{id}', [TaskController::class, 'extendDeadline'])->name('edit.deadline');
    Route::post('user/extend/deadline/rejected/{id}', [TaskController::class, 'rejectedDeadlineExtend'])->name('extend.rejected');
    Route::get('user/settings', [PageController::class, 'settings'])->name('user.settings');
    Route::put('user/settings', [PageController::class, 'updatePassword'])->name('user.password');

        //Response Routes
    Route::get('response/edit/{id}', [ResponseController::class, 'editor'])->name('response.edit');
    Route::put('response/update/{id}', [ResponseController::class, 'update'])->name('response.update');
    Route::get('response/{id}/{responsefile}', [ResponseController::class, 'downlaod'])->name('download.responsefile');
    Route::get('user/activities', [PageController::class, 'userActivities'])->name('user.activities');
    Route::delete('response/destroy/{id}', [ResponseController::class, 'delete'])->name('response.delete');

        //Notification Routes
    Route::put('/notification/read/{id}', [PageController::class, 'read'])->name('notification.read');
});
