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
use App\Http\Controllers\CommandeController;




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

//Route pour chercher un produit avec post
Route::post('/products/search', [GuestController::class, 'search']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Dashboard Client
Route::get('/client/dashboard', [ClientController::class, 'dashboard'])->middleware('auth', 'is_active');

//Pour afficher les informations du client courant qui est connecté 
Route::get('/client/profile', [ClientController::class, 'profile'])->middleware('auth', 'is_active');

//pour mettre à jour le profile de l'admin avec la méthode post
Route::post('/client/profile/update', [ClientController::class, 'updateprofile'])->middleware('auth', 'is_active');

//pour ajouter un review à travers le client connectée
Route::post('/client/review/store', [ClientController::class, 'addReview'])->middleware('auth', 'is_active');

//pour ajouter un produit dans le panier à travers le client
Route::post('/client/order/store', [CommandeController::class, 'store'])->middleware('auth', 'is_active');

//pour gérer la cart des produits commandées par le client 
Route::get('/client/cart', [ClientController::class, 'cart'])->middleware('auth', 'is_active');

//pour supprimer une ligne de commande 
Route::get('/client/lc/{idlc}/destroy', [CommandeController::class, 'lignecommandeDestroy'])->middleware('auth', 'is_active');

//pour faire le checkout d'une commande de client
Route::post('/client/checkout', [ClientController::class, 'checkout'])->middleware('auth', 'is_active');

//pour afficher la liste des commandes de client dans un tableau
Route::get('/client/commandes', [ClientController::class, 'mescommandes'])->middleware('auth', 'is_active');

//pour afficher la page de bloquage de client, sans middleware is_active pour afficher le message de bloquage au client
Route::get('/client/bloquer', [ClientController::class, 'AfficheMessageBloquee'])->middleware('auth');


//Route pour les catégories

//Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->middleware('auth', 'admin');

//Pour afficher les informations de l'admin courant qui est connecté 
Route::get('/admin/profile', [AdminController::class, 'profile'])->middleware('auth', 'admin');

//pour mettre à jour le profile de l'admin avec la méthode post
Route::post('/admin/profile/update', [AdminController::class, 'updateprofile'])->middleware('auth', 'admin');

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

//Route pour afficher les clients de l'admin
Route::get('/admin/clients', [AdminController::class, 'clients'])->middleware('auth', 'admin');

//Route pour bloquer les clients par l'admin
Route::get('/admin/user/{id}/bloquer', [AdminController::class, 'BloqueUser'])->middleware('auth', 'admin');

//Route pour débloquer(activer) les clients par l'admin
Route::get('/admin/user/{id}/activer', [AdminController::class, 'ActiveUser'])->middleware('auth', 'admin');

//Route pour afficher les commandes de clients dans l'espace admin
Route::get('/admin/commandes', [AdminController::class, 'commandes'])->middleware('auth', 'admin');

//Route pour chercher les commandes selon leur caractéristiques(nom, qte)
Route::post('/admin/product/search', [ProductController::class, 'searchProduct'])->middleware('auth', 'admin');

