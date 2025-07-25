<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ModuleAccessController;
use App\Http\Controllers\ApplicationSettingsController;



// ✅ No need to override Sanctum’s built-in CSRF route
// ❌ Remove this:
// Route::get('/sanctum/csrf-cookie', function () {
//     return response()->noContent();
// });



// ✅ Public GET routes that don’t need CSRF protection
Route::get('/api/companies', [CompanyController::class, 'index'])->withoutMiddleware([
    \App\Http\Middleware\VerifyCsrfToken::class,
]);

Route::get('/api/companies/{id}', [CompanyController::class, 'show'])->withoutMiddleware([
    \App\Http\Middleware\VerifyCsrfToken::class,
]);


Route::get('/api/roles/list', [RoleController::class, 'list'])->withoutMiddleware([
    \App\Http\Middleware\VerifyCsrfToken::class,
]);

// ✅ Protected routes for POST (with CSRF + Sanctum stateful)
Route::middleware(['web'])->group(function () {
    Route::post('/api/register', [AuthController::class, 'register']);
    
    Route::get('/api/roles', [RoleController::class, 'index']);
    Route::post('/api/roles', [RoleController::class, 'store']);
    Route::put('/api/roles/{id}', [RoleController::class, 'update']);
    Route::delete('/api/roles/{id}', [RoleController::class, 'destroy']);    


    Route::post('/api/login', [AuthController::class, 'login']);
    Route::get('/api/user/modules', [ModuleAccessController::class, 'userModules']);

    Route::post('/api/logout', [AuthController::class, 'logout']);

    Route::get('/api/settings/{code}', [ApplicationSettingsController::class, 'getSetting']);

});

Route::get('{any}', function () {
    return File::get(public_path('index.html'));
})->where('any', '.*');