<?php

use App\Http\Controllers\Dashboard\AboutController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\ComplaintsController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\CouponsController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LinkController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\PosterController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\SizeController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use NunoMaduro\Collision\Adapters\Phpunit\State;


// use permission;





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



$var  = request()->segment(3);
        $var_2 = rtrim(request()->segment(3), "s");
        $permission = __("sidebar.tables.$var");
        $permission_2 = __("sidebar.tables_.$var_2");
        // $this->middleware(["permission:Display $permission"], ['only' => ['index', 'show']]);

Route::prefix('admin')->middleware(['auth:admin','status','localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
        
        Route::view('/dashboard','dashboard')->name('dashboard');
        Route::as('backend.')->group(function () {
            Route::get('data',[HomeController::class, 'index']);
            Route::resource('users', UsersController::class);
            Route::post('users/multi-delete',[UsersController::class,'MultiDelete'])->name('users.multi-delete');
            Route::resource('admins', AdminController::class);
            Route::post('admins/multi-delete',[AdminController::class,'MultiDelete'])->name('admins.multi-delete');
            Route::post('admins/status/{id}/column/{column}',[AdminController::class,'updateStatus'])->name('admins.status');
            Route::put('admins/admin/update_password',[AdminController::class,'update_password'])->name('admins.update_admin_password');
            Route::get('/admins_get/permissions',[AdminController::class, 'getPermissions'])->name('admins.getPermissions');
            
            Route::view('profile','backend.admins.profile')->name('admins.profile');
            Route::resource('roles', RoleController::class);
            Route::post('roles/multi-delete',[RoleController::class,'MultiDelete'])->name('roles.multi-delete');
            Route::resource('categories', CategoryController::class);
            Route::post('categories/multi-delete',[CategoryController::class,'MultiDelete'])->name('categories.multi-delete');
            Route::post('categories/status/{id}/column/{column}',[CategoryController::class,'updateStatus'])->name('categories.status');
    
            Route::resource('products', ProductController::class);
            Route::post('products/multi-delete',[ProductController::class,'MultiDelete'])->name('products.multi-delete');
            Route::post('products/status/{id}/column/{column}',[ProductController::class,'updateStatus'])->name('products.status');
            Route::post('/generate-qr-pdf/{id}', [ProductController::class, 'qr_code_generate'])->name('qr_code_generate');

            Route::resource('complaints', ComplaintsController::class);
            Route::get('/users_complaiment',[ComplaintsController::class, 'usersComplaiment'])->name('complaiments');
            Route::post('complaints/multi-delete',[ComplaintsController::class,'MultiDelete'])->name('complaints.multi-delete');
            Route::post('complaints/status/{id}/column/{column}',[ComplaintsController::class,'updateStatus'])->name('complaints.status');
            
            Route::resource('coupons', CouponsController::class);
            Route::post('coupons/multi-delete',[CouponsController::class,'MultiDelete'])->name('coupons.multi-delete');
            Route::post('coupons/status/{id}/column/{column}',[CouponsController::class,'updateStatus'])->name('coupons.status');
           
            Route::get('orders',[OrderController::class,'index'])->name('orders.index');
            Route::post('orders/status/{id}/column/{column}',[OrderController::class,'updateStatus'])->name('orders.status');
            Route::post('orders/status/reject/{id}/column/{column}',[OrderController::class,'updateStatusReject'])->name('orders.status.reject');
            
            Route::resource('links', LinkController::class);
            Route::post('links/multi-delete',[LinkController::class,'MultiDelete'])->name('links.multi-delete');
            Route::post('links/status/{id}/column/{column}',[LinkController::class,'updateStatus'])->name('links.status');

            Route::resource('offers', PosterController::class);
            Route::post('offers/multi-delete',[PosterController::class,'MultiDelete'])->name('offers.multi-delete');
            Route::post('offers/status/{id}/column/{column}',[PosterController::class,'updateStatus'])->name('offers.status');
            Route::get('/price/validate',[PosterController::class,'price'])->name('price.validate');

            Route::get('comments',[CommentController::class,'index'])->name('comments.index');
            Route::resource('contacts',ContactController::class);

            Route::get('abouts',[AboutController::class,'index'])->name('abouts.index');
            Route::post('abouts/store',[AboutController::class,'store'])->name('abouts.store');

            Route::resource('sizes', SizeController::class);
        });
        
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
