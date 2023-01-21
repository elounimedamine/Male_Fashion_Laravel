<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Dashboard Client
Route::get('/client/dashboard', [ClientController::class, 'dashboard']);

//Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth', 'admin');

//Affichage de la liste des catégories
Route::get('/admin/categories', [CategoryController::class, 'index'])->middleware('auth', 'admin');

//Ajouter une catégorie
Route::post('/admin/categories/store', [CategoryController::class, 'store'])->middleware('auth', 'admin');

//Modifier une catégorie
Route::post('/admin/categories/update', [CategoryController::class, 'update'])->middleware('auth', 'admin');

//Supprimer une catégorie
Route::get('/admin/categories/{id}/delete', [CategoryController::class, 'destroy'])->middleware('auth', 'admin');



