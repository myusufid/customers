<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return redirect()->route('customers.index');
});
Route::resource('customers', CustomerController::class)
    ->except(['destroy'])
    ->names([
        'index' => 'customers.index',
        'create' => 'customers.create',
        'store' => 'customers.store',
        'edit' => 'customers.edit',
        'update' => 'customers.update',
    ]);

Route::delete('customers/{customer}/destroy', [CustomerController::class, 'destroy'])
    ->name('customers.destroy');
Route::get('customers-data', [CustomerController::class, 'data'])->name('customers.data');
