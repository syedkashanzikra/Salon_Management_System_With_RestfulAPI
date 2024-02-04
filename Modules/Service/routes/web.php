<?php

use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;
use Modules\Service\Http\Controllers\Backend\ServicePackageController;
use Modules\Service\Http\Controllers\Backend\ServicesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
*
* Backend Routes
*
* --------------------------------------------------------------------
*/
Route::group(['prefix' => 'app', 'as' => 'backend.', 'middleware' => ['web', 'auth']], function () {
    /*
    * These routes need view-backend permission
    * (good if you want to allow more than one group in the backend,
    * then limit the backend features by different roles or permissions)
    *
    * Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
    */

    /*
     *
     *  Backend Services Routes
     *
     * ---------------------------------------------------------------------
     */
    // Services Routes
    Route::group(['prefix' => 'services', 'as' => 'services.'], function () {

        Route::get('/index_list', [ServicesController::class, 'index_list'])->name('index_list');
        Route::get('/index_data', [ServicesController::class, 'index_data'])->name('index_data');
        Route::get('/trashed', [ServicesController::class, 'trashed'])->name('trashed');
        Route::patch('/trashed/{id}', [ServicesController::class, 'restore'])->name('restore');

        Route::get('/index_list_data', [ServicesController::class, 'index_list_data'])->name('index_list_data');

        // Assign Staff
        Route::get('/assign-employee/{id}', [ServicesController::class, 'assign_employee_list'])->name('assign_employee_list');
        Route::post('/assign-employee/{id}', [ServicesController::class, 'assign_employee_update'])->name('assign_employee_update');

        // Assign Branch
        Route::get('/assign-branch/{id}', [ServicesController::class, 'assign_branch_list'])->name('assign_branch_list');
        Route::post('/assign-branch/{id}', [ServicesController::class, 'assign_branch_update'])->name('assign_branch_update');

        // Gallery Images
        Route::get('/gallery-images/{id}', [ServicesController::class, 'getGalleryImages']);
        Route::post('/gallery-images/{id}', [ServicesController::class, 'uploadGalleryImages']);
        Route::post('bulk-action', [ServicesController::class, 'bulk_action'])->name('bulk_action');
        Route::post('update-status/{id}', [ServicesController::class, 'update_status'])->name('update_status');
        Route::get('export', [ServicesController::class, 'export'])->name('export');
    });
    Route::resource('services', ServicesController::class);

    // Service Packages
    Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
        Route::group(['prefix' => '/servicepackage', 'as' => 'servicepackage.'], function () {
            Route::get('index_data', [ServicePackageController::class, 'index_data'])->name('index_data');
            Route::get('/index_list_data', [ServicesController::class, 'index_list_data'])->name('index_list_data');
            Route::get('/category_list', [ServicePackageController::class, 'category_list'])->name('category_list');
        });
        Route::get('/category_service_list', [ServicesController::class, 'categort_services_list']);
        Route::get('/index_list', [ServicesController::class, 'index_list'])->name('index_list');
        Route::get('/user-list', [UserController::class, 'user_list'])->name('user_list');
        Route::get('index_data', [ServicePackageController::class, 'index_data'])->name('index_data');
        Route::post('bulk-action', [ServicePackageController::class, 'bulk_action'])->name('bulk_action');
        Route::post('update-status/{id}', [ServicePackageController::class, 'update_status'])->name('update_status');
        Route::resource('servicepackage', ServicePackageController::class);
        Route::get('/', 'TaxController@index');

    });

});
