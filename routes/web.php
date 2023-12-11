<?php

use App\Http\Controllers\Frontend\homeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/',[homeController::class,'index']);

Route::get('/admin/dashboard', function () {
    return view('Backend.Pages.Dashboard.index');
});
