<?php

use App\Http\Controllers\AchatsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\FournisseursController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VentesController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';






// Routes de Dashboard
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard.index');

// Routes de Clients
Route::get('/clients',[ClientsController::class,'index'])->name('clients.index');
Route::get('/clients/{id}/edit',[ClientsController::class,'edit'])->name('clients.edit');
Route::post('/clients/{id}',[ClientsController::class,'update'])->name('clients.update');
Route::get('/clients/create',[ClientsController::class,'create'])->name('clients.create');
Route::post('/clients',[ClientsController::class,'store'])->name('clients.store');
Route::delete('/clients/{id}', [ClientsController::class, 'destroy'])->name('clients.destroy');
Route::post('/envoyer-email-aux-clients/{email}', [ClientsController::class,'envoyerEmailAuxClients'])->name('clients.mail');

// Routes de Produits

Route::get('/produits',[ProduitsController::class,'index'])->name('produits.index');
Route::get('/produits/{id}/edit',[ProduitsController::class,'edit'])->name('produits.edit');
Route::post('/produits/{id}',[ProduitsController::class,'update'])->name('produits.update');
Route::get('/produits/create',[ProduitsController::class,'create'])->name('produits.create');
Route::post('/produits',[ProduitsController::class,'store'])->name('produits.store');
Route::delete('/produits/{id}', [ProduitsController::class, 'destroy'])->name('produits.destroy');

// Routes de Ventes

Route::get('/ventes',[VentesController::class,'index'])->name('ventes.index');
Route::get('/ventes/{id}/edit',[VentesController::class,'edit'])->name('ventes.edit');
Route::post('/ventes/{id}',[VentesController::class,'update'])->name('ventes.update');
Route::get('/ventes/create',[VentesController::class,'create'])->name('ventes.create');
Route::post('/ventes',[VentesController::class,'store'])->name('ventes.store');
Route::delete('/ventes/{id}', [VentesController::class, 'destroy'])->name('ventes.destroy');

// Routes de Achats

Route::get('/achats',[AchatsController::class,'index'])->name('achats.index');
Route::get('/achats/{id}/edit',[AchatsController::class,'edit'])->name('achats.edit');
Route::post('/achats/{id}',[AchatsController::class,'update'])->name('achats.update');
Route::get('/achats/create',[AchatsController::class,'create'])->name('achats.create');
Route::post('/achats',[AchatsController::class,'store'])->name('achats.store');
Route::delete('/achats/{id}', [AchatsController::class, 'destroy'])->name('achats.destroy');

// Routes de Fournisseurs

Route::get('/fournisseurs',[FournisseursController::class,'index'])->name('fournisseurs.index');
Route::get('/fournisseurs/{id}/edit',[FournisseursController::class,'edit'])->name('fournisseurs.edit');
Route::post('/fournisseurs/{id}',[FournisseursController::class,'update'])->name('fournisseurs.update');
Route::get('/fournisseurs/create',[FournisseursController::class,'create'])->name('fournisseurs.create');
Route::post('/fournisseurs',[FournisseursController::class,'store'])->name('fournisseurs.store');
Route::delete('/fournisseurs/{id}', [FournisseursController::class, 'destroy'])->name('fournisseurs.destroy');
Route::post('/envoyer-email-aux-fournisseurs/{email}', [FournisseursController::class,'envoyerEmailAuxFournisseurs'])->name('fournisseurs.mail');


// Routes de Factures

Route::get('/factures',[FacturesController::class,'index'])->name('factures.index');
Route::get('/factures/{id}/edit',[FacturesController::class,'edit'])->name('factures.edit');
Route::post('/factures/{id}',[FacturesController::class,'update'])->name('factures.update');
Route::get('/factures/create',[FacturesController::class,'create'])->name('factures.create');
Route::post('/factures',[FacturesController::class,'store'])->name('factures.store');
Route::delete('/factures/{id}', [FacturesController::class, 'destroy'])->name('factures.destroy');
Route::get('/api/ventes/{client}', [VentesController::class,'getVentesByClient']);



