<?php

use App\Http\Controllers\ActionPlanController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeedbackSourceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\RegisterController;

// Public Routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/register/departments', [RegisterController::class, 'getDepartment']);


// Protected Routes
Route::middleware('auth:sanctum')->group(function () {

    // User Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/{id}', 'show');
        Route::post('/users', 'store');
        Route::put('/users/{id}', 'update');
        Route::delete('/users/{id}', 'delete');
        Route::patch('/users/{id}/status', 'updateStatus');
        Route::patch('/users/{id}/assign', 'assignUser');
        Route::patch('/users/{id}/un-assign', 'unAssignUser');
    });


    // User Account Routes
    Route::controller(UserController::class)->group(function () {
        Route::get('/user-account', 'userAccount');
        Route::patch('/user-account/change-password', 'changePassword');
    });


    // Colleges Routes
    Route::controller(CollegeController::class)->group(function () {
        Route::get('/colleges', 'index');
        Route::get('/colleges/{id}', 'show');
        Route::post('/colleges', 'store');
        Route::put('/colleges/{id}', 'update');
        Route::delete('/colleges/{id}', 'delete');
        Route::get('/colleges/{id}/action-plans', 'getActionPlans');
        Route::get('/colleges/{id}/programs', 'getPrograms');
        Route::get('/colleges/{id}/users', 'getUsers');
    });


    // Programs Routes
    Route::controller(ProgramController::class)->group(function () {
        Route::get('/programs', 'index');
        Route::get('/programs/{id}', 'show');
        Route::post('/programs', 'store');
        Route::put('/programs/{id}', 'update');
        Route::delete('/programs/{id}', 'delete');
        Route::get('/programs/{id}/action-plans', 'getActionPlans');
        Route::get('/programs/{id}/users', 'getUsers');
    });


    // Action Plans Routes
    Route::controller(ActionPlanController::class)->group(function () {
        Route::get('/action-plans', 'index');
        Route::get('/action-plans/{id}', 'show');
        Route::post('/action-plans', 'store');
        Route::put('/action-plans/{id}', 'update');
        Route::delete('/action-plans/{id}', 'delete');
    });


    // Comment Routes
    Route::controller(CommentController::class)->group(function () {
        Route::get('/comments/{id}', 'index');
        Route::post('/comments', 'store');
        Route::delete('/comments/{id}', 'delete');
    });


    // Feedback Sources Routes
    Route::controller(FeedbackSourceController::class)->group(function () {
        Route::get('/feedback-sources', 'index');
        Route::get('/feedback-sources/{id}', 'show');
        Route::post('/feedback-sources', 'store');
        Route::put('/feedback-sources/{id}', 'update');
        Route::delete('/feedback-sources/{id}', 'delete');
    });


    // Notifications Routes
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'index');
        Route::get('/notifications/{id}', 'show');
        Route::post('/notifications', 'store');
        Route::delete('/notifications/{id}', 'delete');
        Route::patch('/notifications/{id}', 'updateStatus');
    });


    // Dashboard Routes
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/reports/count', 'count');
        Route::get('/reports/action-plans', 'actionPlans');
        Route::get('/reports/action-plans/annual', 'annualActionPlansReport');
        Route::get('/reports/action-plans/delayed', 'delayedActionPlans');
        Route::get('/reports/action-plans/latest', 'latestActionPlans');
    });










    // Logout User
    Route::post('/logout', [AuthController::class, 'logout']);
});
