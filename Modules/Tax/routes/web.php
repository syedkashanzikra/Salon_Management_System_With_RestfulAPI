<?php

use Illuminate\Support\Facades\Route;
use Modules\Tax\Http\Controllers\Backend\TaxesController;

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
     *  Backend Taxes Routes
     *
     * ---------------------------------------------------------------------
     */

    Route::group(['prefix' => 'tax', 'as' => 'tax.'], function () {
        Route::get('index_list', [TaxesController::class, 'index_list'])->name('index_list');
        Route::get('index_data', [TaxesController::class, 'index_data'])->name('index_data');
        Route::get('trashed', [TaxesController::class, 'trashed'])->name('trashed');
        Route::patch('trashed/{id}', [TaxesController::class, 'restore'])->name('restore');
        Route::post('update-status/{id}', [TaxesController::class, 'update_status'])->name('update_status');
        Route::post('bulk-action', [TaxesController::class, 'bulk_action'])->name('bulk_action');
    });
    Route::resource('tax', TaxesController::class);
});
