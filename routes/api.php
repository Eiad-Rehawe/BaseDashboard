<?php

use App\Http\Controllers\Mobile\AuthenticatController;
use App\Http\Controllers\Mobile\ForgotPasswordController;
use App\Http\Controllers\Mobile\IndexController ;
use App\Http\Controllers\Mobile\OrdersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>'Localization'],function(){
    Route::post('login',[AuthenticatController::class, 'login']);
    Route::post('verify_email',[AuthenticatController::class, 'verifyOtp']);
    Route::post('register',[AuthenticatController::class, 'register']);
    Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm']); 
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm']);
    Route::get('products',[IndexController::class, 'getProducts']);
    Route::get('categories',[IndexController::class, 'getCategories']);
    Route::get('/product/{id}',[IndexController::class, 'showProduct']);
    Route::get('/product/by/barcode/{id}',[IndexController::class, 'showProductByBarcode']);
    Route::get('/products/by/categoryId/{id}', [IndexController::class, 'ShowProductsByCategoryId']);

    Route::post('filter_products',[IndexController::class, 'filterProducts']); //test on postamn
    Route::get('/latest/products',[IndexController::class, 'latest_products']);
    Route::get('/categories/offers',[IndexController::class, 'offer_categories']);
    Route::get('products/offers',[IndexController::class, 'offer_products']);
    Route::post('/store/contact',[IndexController::class, 'contact']);
    Route::get('/about',[IndexController::class, 'about']);
    Route::post('comment',[IndexController::class, 'comment']);
    Route::get('/getComments',[IndexController::class, 'getComments']);
    Route::get('featured_cat',[IndexController::class, 'featured_cat']);
    Route::get('min_max',[IndexController::class, 'min_max']);
    Route::middleware('auth:sanctum','verified')->group(function(){
        Route::post('logout',[AuthenticatController::class, 'logout']);
        Route::post('/product/order',[IndexController::class, 'AddOrder']);
        Route::post('review',[IndexController::class, 'review']);
        Route::post('/cancelOrder/{id}',[IndexController::class, 'cancelOrder']);
        Route::post('/product/complaiment',[IndexController::class, 'storeProductComplaimen']);
        Route::post('public/employee/complaiment',[IndexController::class, 'storePublicOrEmployeeComplaiment']);
        Route::post('/store/fav',[IndexController::class, 'favourite']);
        Route::get('/get/fav',[IndexController::class, 'favouriteProducts']);

        Route::get('/my_orders',[OrdersController::class, 'my_orders']);
        Route::put('/update_Order',[OrdersController::class, 'updateOrder']);
        Route::post('/add/products/order',[OrdersController::class, 'addProductsToOrder']);
        Route::post('delete/product/order',[OrdersController::class, 'deleteProductOrder']);
        Route::post('/delete/whole/order',[OrdersController::class, 'deleteOrder']);
    });
});
