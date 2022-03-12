<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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

Route::get('/', [PagesController::class, 'index']);
Route::get('/about', [PagesController::class, 'about']);




// /products = all products
// /products/productName
// /products/id
// Pattern is integer
// Route::get('/products/{id}', [ProductsController::class, 'show'])->where('id', '[0-9]+');

// Pattern is string
//Route::get('/products/{name}/{id}', [ProductsController::class, 'show'])->where([
//    'name' => '[a-zA-Z]+',
//    'id' => '[0-9]+',
//    ]);




// Laravel 8 (New)
//Route::get('/products',
//    [ProductsController::class, 'index'])->name('products');
//Route::get('/products/about', [ProductsController::class, 'about']);

// Laravel 8 (Also New)
//Route::get('/products', 'App\Http\Controllers\ProductsController@index');

// Before Laravel 8 (Not Working)
//Route::get('/products', 'ProductsController@index');

/*
// Route that sends back a view
Route::get('/', function () {
    return view('home');
});
*/












/*
// Route to users - string
Route::get('/users', function () {
    return 'Welcome to the users page';
});

// Route to users - Array(JSON)
Route::get('/users', function () {
    return ['PHP', 'HTML', 'Laravel'];
});

// Route to users - JSON object
Route::get('/users', function () {
    return response()->json([
        'name' => 'Neko',
        'course' => 'Laravel Begineers To Advanced'
    ]);
});

// Route to users - function
Route::get('/users', function () {
    return redirect('/');
});

// firstproject.com == /
// firstproject.com/users == /users
*/

