<?php

use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ComplaintsController;
use App\Http\Controllers\Frontend\FrontController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Frontend\RatingController;
use App\Http\Controllers\Mobile\IndexController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\SizeController;








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

Route::middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () 
{
  Route::get('/product/{id}',[FrontController::class, 'get_product'])->name('front.product');

  Route::get('/check-product', [FrontController::class, 'checkProduct']);

  Route::middleware(['auth:web','verified'])->group(function(){
    // Route::post('review',[FrontController::class, 'review']);
    Route::post('/rating/store',[RatingController::class,'store'])->name('rating.store');
    Route::post('comment',[FrontController::class, 'comment'])->name('comment');
    Route::post('get_coupon',[CartController::class, 'get_coupon'])->name('get_coupon');
    // Route::get('get_coupon',[CartController::class, 'get_coupon'])->name('get_coupon');

    Route::post('/product/store',[CartController::class, 'storeOrder'])->name('storeOrder');
    Route::post('complaints', [ComplaintsController::class,'store'])->name('user.complaints');
    Route::post('/favourite',[FrontController::class, 'favourite'])->name('favourite');
    Route::post('public/employee/complaiment',[ComplaintsController::class, 'storePublicOrEmployeeComplaiment'])->name('public.employee.complaiment');
    // Route::get('fav',[FrontController::class, 'favouriteProducts'])->name('fav');
    Route::get('/get/fav',[FrontController::class, 'favouriteApiProducts']);
    Route::get('/my_orders',[OrderController::class, 'my_orders'])->name('my_orders');
    Route::get('/getDetails',[OrderController::class, 'getDetails'])->name('getDetails');
    Route::delete('/deleteProductOrder',[OrderController::class, 'deleteProductOrder'])->name('deleteProductOrder');
    Route::get('/editOrder',[OrderController::class, 'editOrder'])->name('editOrder');
    Route::put('/updateOrder',[OrderController::class, 'updateOrder'])->name('updateOrder');
    Route::post('/add_products_to_order',[OrderController::class, 'addProductsToOrder'])->name('add_products_to_order');
    Route::delete('/deleteOrder',[OrderController::class, 'deleteOrder'])->name('deleteOrder');
  });
  Route::get('about_us',[FrontController::class,'about'])->name('about_us');
  
  Route::view('complaiment','pages.complaiment')->name('complaiment');
  Route::view('/contac_us','pages.contact')->name('contact_us');
  Route::post('/add/contact',[FrontController::class, 'contact'])->name('user.contact');
  Route::get('/cart',action: [CartController::class, 'index'])->name('cart');
  Route::get('fav',[FrontController::class, 'favouriteProducts'])->name('fav');
  Route::view('compare','pages.compare')->name('compare');
  Route::get('/compare/product',[FrontController::class, 'compare'])->name('product.compare');
  Route::view('shop','pages.shop')->name('shop');
  Route::get('checkout',[CartController::class,'checkoutPage'])->name('checkout');
  Route::get('/shop/search',[FrontController::class, 'shop'])->name('shop.search');
Route::get('product/category/compare',[FrontController::class, 'category']);
  Route::get('/getProductWhenClickCart/{id}',[FrontController::class, 'getProductWhenClickCart'])->name('getProductWhenClickCart');
  Route::get('/',[FrontController::class, 'welcome'])->name('home');
  Route::get('featured_cat',[FrontController::class, 'featured_cat']);
});
// ->middleware(['auth:web','verified']);



// Route::prefix(LaravelLocalization::setLocale())->middleware(['auth:admin','localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
//     Route::view('/dashboard','dashboard')->name('dashboard');
//     Route::as('backend.')->group(function () {
//         Route::resource('users', UsersController::class);
//         Route::post('users/multi-delete',[UsersController::class,'MultiDelete'])->name('users.multi-delete');
//     });
// });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

