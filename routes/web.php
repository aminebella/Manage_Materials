<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\ADashboardController;
use App\Http\Controllers\Admin\AUserController;
use App\Http\Controllers\Admin\AMaterialController;
use App\Http\Controllers\Admin\ARequestController;
use App\Http\Controllers\Admin\AMaintenanceController;

// Routes pour l'admin sans middleware pour le moment
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [ADashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD pour les utilisateurs
    Route::resource('users', AUserController::class);

    // CRUD pour les matériels
    Route::resource('materials', AMaterialController::class);

    // CRUD pour les demandes
    Route::resource('requests', ARequestController::class);

    // CRUD pour les maintenances
    Route::resource('maintenances', AMaintenanceController::class);
});


// Route::get('/admin/dashboard', function () {
//     return view('admin/dashboard');
// })->name('admin.dashboard');

// Route::get('/admin/users', function () {
//     return view('admin/users');
// })->name('admin.users');

// Route::get('/admin/equipements', function () {
//     return view('admin/equipements');
// })->name('admin.equipements');

// Route::get('/admin/requests', function () {
//     return view('admin/requests');
// })->name('admin.requests');

// Route::get('/admin/maintenance', function () {
//     return view('admin/maintenance');
// })->name('admin.maintenance');

// /*
// |--------------------------------------------------------------------------
// | Admin Web Routes
// |--------------------------------------------------------------------------
// |
// */

// use App\Http\Controllers\Admin\ADashboardController;
// use App\Http\Controllers\Admin\AUserController;//all users (can manage)
// use App\Http\Controllers\Admin\AMaterialController;//all materials (can manage)
// use App\Http\Controllers\Admin\ARequestController;// all request (can accepte or deny)
// use App\Http\Controllers\Admin\AMaintenanceController;// all maintenance  (can do as inprogress or done maintenance)

// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/dashboard', [ADashboardController::class, 'index'])->name('admin.dashboard');
    
//     Route::resource('users', AUserController::class); // CRUD Users
//     Route::resource('materials', AMaterialController::class); // CRUD Materials
//     Route::resource('requests', ARequestController::class); // CRUD Requests
//     Route::resource('maintenances', AMaintenanceController::class); // CRUD Maintenances
// });


// /*
// |--------------------------------------------------------------------------
// | User Web Routes
// |--------------------------------------------------------------------------
// |
// */

// use App\Http\Controllers\User\UDashboardController;//all materials (can do request btn)
// use App\Http\Controllers\User\UMyMaterialController;// the material i occupe (can do maintenance btn)
// use App\Http\Controllers\User\UMaterialRequestController;//the material i request having /i demande : in attends / accepted / rejected
// use App\Http\Controllers\User\UMaintenanceRequestController;//the material i send to maintenance: in progress / done


// Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
//     Route::get('/dashboard', [UDashboardController::class, 'index'])->name('user.dashboard');
    
//     // Liste des matériaux et demande de matériel
//     Route::get('materials', [UMaterialRequestController::class, 'index'])->name('user.materials.index');
//     Route::post('materials/request', [UMaterialRequestController::class, 'store'])->name('user.materials.request');
    
//     // Liste des matériaux de l'utilisateur et demande de maintenance
//     Route::get('my-materials', [UMyMaterialController::class, 'index'])->name('user.my-materials.index');
//     Route::post('my-materials/maintenance', [UMaintenanceRequestController::class, 'store'])->name('user.my-materials.maintenance');
    
//     // Demandes de maintenance et de matériel de l'utilisateur
//     Route::get('requests', [UMaterialRequestController::class, 'userRequests'])->name('user.requests.index');
//     Route::get('maintenances', [UMaintenanceRequestController::class, 'userMaintenances'])->name('user.maintenances.index');
// });

