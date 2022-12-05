<?php

namespace TypiCMS\Modules\Users\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use TypiCMS\Modules\Users\Http\Controllers\AdminController;
use TypiCMS\Modules\Users\Http\Controllers\ApiController;
use TypiCMS\Modules\Users\Http\Controllers\LoginController;

class RouteServiceProvider extends ServiceProvider
{
    public function map()
    {
        /*
         * Front office routes
         */
        Route::middleware('web')->group(function (Router $router) {
            $router->get('THBackyard', [LoginController::class, 'showLoginForm'])->name('login');
            $router->post('THBackyard', [LoginController::class, 'login']);
            $router->post('logout', [LoginController::class, 'logout'])->name('logout');
        });

        Route::redirect('/.well-known/change-password', '/'.app()->getLocale().'/password/reset');

        /*
         * Admin routes
         */
        Route::middleware('admin')->prefix('admin')->name('admin::')->group(function (Router $router) {
            $router->get('users', [AdminController::class, 'index'])->name('index-users')->middleware('can:read users');
            $router->get('users/export', [AdminController::class, 'export'])->name('admin::export-users')->middleware('can:read users');
            $router->get('users/create', [AdminController::class, 'create'])->name('create-user')->middleware('can:create users');
            $router->get('users/{user}/edit', [AdminController::class, 'edit'])->name('edit-user')->middleware('can:read users');
            $router->post('users', [AdminController::class, 'store'])->name('store-user')->middleware('can:create users');
            $router->put('users/{user}', [AdminController::class, 'update'])->name('update-user')->middleware('can:update users');
        });

        /*
         * API routes
         */
        Route::middleware(['api', 'auth:api'])->prefix('api')->group(function (Router $router) {
            $router->get('users', [ApiController::class, 'index'])->middleware('can:read users');
            $router->post('users/current/updatepreferences', [ApiController::class, 'updatePreferences'])->middleware('can:update users');
            $router->delete('users/{user}', [ApiController::class, 'destroy'])->middleware('can:delete users');
        });
    }
}
