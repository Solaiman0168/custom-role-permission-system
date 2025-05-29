<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;

Route::get('/', function () {
    return view('welcome');
});


// Admin routes group (protected by auth, admin role, and permissions)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Permissions Management
    Route::resource('permissions', PermissionController::class)
        ->except(['show']) // Remove if you need show view
        ->middleware('permission:manage_permissions');

    // Roles Management
    Route::resource('roles', RoleController::class)
        ->except(['show']) // Remove if you need show view
        ->middleware('permission:manage_roles');

    // Additional assignment routes
    Route::post('permissions/{permission}/assign-roles', [PermissionController::class, 'assignRoles'])
        ->name('permissions.assign-roles')
        ->middleware('permission:manage_permissions');

    Route::post('roles/{role}/assign-permissions', [RoleController::class, 'assignPermissions'])
        ->name('roles.assign-permissions')
        ->middleware('permission:manage_roles');
});


