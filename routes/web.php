<?php

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


//Route::get("/okok",App\Http\Livewire\Resetpassword::class);



Route::group(['middleware' => 'auth'], function () {

Route::get("/product",App\Http\Livewire\Productlist::class);
Route::get("/clients",App\Http\Livewire\Clientlist::class);
Route::get("/category",App\Http\Livewire\Listcategory::class);
Route::get("/stock",App\Http\Livewire\Stocklist::class);
Route::get("/stock-entry",App\Http\Livewire\Stockentry::class);
Route::get("/payments",App\Http\Livewire\Paymentlist::class);
Route::get("/expense",App\Http\Livewire\Expenselist::class);
Route::get("/sale",App\Http\Livewire\Dailysale::class);

});

Route::group(['middleware' => 'can:viewAny,App\Models\User'], function () {

Route::get("/vendorledger",App\Http\Livewire\Vendorledger::class);
Route::get("/customerledger",App\Http\Livewire\Customerledger::class);
Route::get("/saleledger",App\Http\Livewire\Saleledger::class);
Route::get("/ledger",App\Http\Livewire\Gledger::class);
Route::get("/profit-loss",App\Http\Livewire\Profitledger::class);
Route::get("/stock-inhand",App\Http\Livewire\Stockinhand::class);
Route::get("/stockledger",App\Http\Livewire\Stockledger::class);
Route::get("/user",App\Http\Livewire\Usermanagement::class);
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/print/{saleid}', [App\Http\Controllers\HomeController::class, 'print'])->name('print');
Auth::routes([
    'register' => false, // Disables registration routes
    'reset' => false,    // Disables password reset routes
    'verify' => false    // Disables email verification routes
]);

// Route::get("/user",App\Http\Livewire\Usermanagement::class)->middleware('can:viewAny,App\Models\User');
