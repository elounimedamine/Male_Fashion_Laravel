<?php

use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\ProductController;



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

// Route::get('/', function () {
//     return view('welcome');
// });

//Guest Routes
//page principale pour le guest
Route::get('/', [GuestController::class, 'home']);

//page de details produit avec {id} est l'id du produit
Route::get('/product/details/{id}', [GuestController::class, 'productDetails']);

//page des produits de chaque catégorie avec {category} est l'id du catégorie
Route::get('/product/{category}/list', [GuestController::class, 'shop']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Dashboard Client
Route::get('/client/dashboard', [ClientController::class, 'dashboard']);

//Route pour les catégories

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

// Route pour les produits

//Affichage de la liste des produits
Route::get('/admin/products', [ProductController::class, 'index'])->middleware('auth', 'admin');

//Ajouter une catégorie
Route::post('/admin/products/store', [ProductController::class, 'store'])->middleware('auth', 'admin');

//Modifier une catégorie
Route::post('/admin/products/update', [ProductController::class, 'update'])->middleware('auth', 'admin');

//Supprimer une catégorie
Route::get('/admin/products/{id}/delete', [ProductController::class, 'destroy'])->middleware('auth', 'admin');