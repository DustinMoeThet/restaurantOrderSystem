<?php

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;

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
//login,register
Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth'
])->group(function () {
    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function () {
        //Category
        Route::prefix()->group(function(){
            Route::get('list', [CategoryController::class, 'list'])->name('category#list');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('category#edit');
            Route::post('update/{id}', [CategoryController::class, 'update'])->name('category#update');
        });
        //admin account
        Route::prefix('admin')->group(function () {
            //password change
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('changePassword',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('account_detail',[AdminController::class,'details'])->name('admin#details');

            //profile edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');

            //userListPage
            Route::get('userList',[AdminController::class,'userList'])->name('admin#userList');
            Route::get('userChangeRole/{id}',[AdminController::class,'userChangeRole'])->name('admin#userChangeRole');
        });
        //products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'createProduct'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'deleteProduct'])->name('product#delete');
            Route::get('edit/{id}',[ProductController::class,'editPage'])->name('product#editPage');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
            Route::get('details/{id}',[ProductController::class,'detailPage'])->name('product#detailPage');

        });
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'list'])->name('admin#orderList');
            Route::get('filter', [AjaxController::class,'orderFilter'])->name('admin#orderFilter');
            Route::get('detail/{order_code}',[OrderController::class,'orderDetail'])->name('admin#orderDetail');
            Route::post('acceptDeny/{id}',[OrderController::class,'acceptDeny'])->name('order#acceptDeny');
        });
    });

    //user
    //home
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('/homePage',[UserController::class,'home'])->name('user#home');
        Route::get('/history',[UserController::class,'history'])->name('user#history');

        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });
        Route::prefix('profile')->group(function(){
            Route::get('change',[UserController::class,'accountDetailChangePage'])->name('user#detailChangePage');
            Route::post('update',[UserController::class,'update'])->name('user#detailUpdate');
        });
        Route::prefix('product')->group(function(){
            Route::get('detail/{id}',[UserController::class,'productDetail'])->name('user#productDetail');
        });
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            Route::get('listDelete/{id}',[UserController::class,'cartListDelete'])->name('user#cartListDelete');
            Route::get('cartDelete',[UserController::class,'cartDelete'])->name('user#cartDelete');
        });
        Route::prefix('ajax')->group(function(){
            Route::get('product/list',[AjaxController::class,'productList'])->name('ajax#list');
            Route::get('product/filter/{id}',[AjaxController::class,'productFilter'])->name('ajax#productFilter');
            Route::get('product/addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('product/order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#viewCount');
        });
    });
});




//user

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
