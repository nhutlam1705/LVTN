<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\admin\AdminController;


Route::get('/admin/home', [AdminController::class, 'index'])->name('admin.home');
Route::get('/admin/revenue', [AdminController::class, 'getMonthlyRevenue'])->name('admin.revenue');
// trả lời khách hàng
Route::post('/admin/contacts/{id}/reply', [AdminController::class, 'reply'])->name('contact.reply');

use App\Http\Controllers\AuthController;
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Route::get('/', function () {
//     return view('pages.index');
// })->middleware('auth')->name('home');



Route::prefix('admin')->group(function (){
    Route::prefix('AccountManager')->group(function (){
        Route::get('/ShowAccount', [UserController::class, 'index'])->name('AccountManager.ShowAccount');
        Route::get('/CreateAccount', [UserController::class, 'create'])->name('AccountManager.CreateAccount');
        Route::post('/AccountManager', [UserController::class, 'store'])->name('AccountManager.store');
        Route::get('/{id}/EditAccount', [UserController::class, 'edit'])->name('AccountManager.EditAccount');
        Route::put('/{id}', [UserController::class, 'update'])->name('AccountManager.UpdateAccount');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('AccountManager.Destroy');

    });
    Route::prefix('ProductManager')->group(function (){
        Route::get('/ShowProduct', [ProductController::class, 'index'])->name('ProductManager.ShowProduct');
        Route::get('/CreateProduct', [ProductController::class, 'create'])->name('ProductManager.CreateProduct');
        Route::post('/ProductManager', [ProductController::class, 'store'])->name('ProductManager.store');
        Route::get('/{id}/EditProduct', [ProductController::class, 'edit'])->name('ProductManager.EditProduct');
        Route::put('/{id}', [ProductController::class, 'update'])->name('ProductManager.UpdateProduct');
        Route::delete('/{id}', [ProductController::class, 'destroy'])->name('ProductManager.Destroy');
        Route::post('/StoreCategory', [ProductController::class, 'storeCategory'])->name('ProductManager.StoreCategory');

    });
    Route::prefix('VoucherManager')->group(function (){
        Route::get('/ShowVoucher', [VoucherController::class, 'index'])->name('vouchers.index');
        Route::get('CreateVoucher', [VoucherController::class, 'create'])->name('vouchers.create');
        Route::post('vouchers', [VoucherController::class, 'store'])->name('vouchers.store');
        Route::get('/{id}/edit', [VoucherController::class, 'edit'])->name('vouchers.edit');
        Route::put('/{id}', [VoucherController::class, 'update'])->name('vouchers.update');
        Route::delete('/{id}', [VoucherController::class, 'destroy'])->name('vouchers.destroy');
    });

    Route::prefix('InformationManager')->group(function (){
        Route::get('/ShowInfomation', [InformationController::class, 'index'])->name('InformationManager.ShowInformation');
        Route::get('/CreateInformation', [InformationController::class, 'create'])->name('InformationManager.CreateInformation');
        Route::post('/InformationManager', [InformationController::class, 'store'])->name('InformationManager.store');
        Route::get('/{id}/EditInformation', [InformationController::class, 'edit'])->name('InformationManager.Edit');
        Route::put('/{id}', [InformationController::class, 'update'])->name('InformationManager.Update');
        Route::delete('/{id}', [InformationController::class, 'destroy'])->name('InformationManager.Destroy');
        Route::post('/ckeditor/upload', [InformationController::class, 'upload'])->name('ckeditor.upload');
    });
    Route::prefix('OrderManager')->group(function (){
        Route::get('/OrderManager/ShowOrders', [OrderController::class, 'index'])->name('orders.show');
        Route::put('/OrderManager/update/{id}', [OrderController::class, 'update'])->name('orders.update');
        Route::put('/OrderManager/updatecheck/{id}', [OrderController::class, 'updatecheck'])->name('orders.updatecheck');

    });
    Route::prefix('StockManager')->group(function (){
        Route::get('/stocks', [StockController::class, 'index'])->name('stock.show');
        Route::post('stocks/{id}/in', [StockController::class, 'storeIn'])->name('stocks.in');
        Route::post('stocks/{id}/out', [StockController::class, 'storeOut'])->name('stocks.out');

    });
});

use App\Http\Controllers\pages\HomeController;
use App\Http\Controllers\pages\CartController;
use App\Http\Controllers\pages\PaymentController;

//home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categoryProduct', [Homecontroller::class, 'categoryProduct'])->name('productCategory');


//cart 
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart', [CartController::class, 'showCart'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/apply-voucher', [CartController::class, 'applyVoucher'])->name('apply-voucher');

// check out
Route::post('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/payment', [PaymentController::class, 'showPaymentInfo'])->name('payment.info');
Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('payment.cancel');

//thanh toán
Route::post('/payment/momo', [PaymentController::class, 'MoMoPayment'])->name('payment.momo');
Route::post('/payment/vnpay', [PaymentController::class, 'VNPayPayment'])->name('payment.vnpay');
Route::get('vnpay/success', [PaymentController::class, 'vnpaySuccess'])->name('vnpay.success');
Route::post('/payment/stripe', [PaymentController::class, 'StripePayment'])->name('payment.stripe');
Route::post('/payment/cod', [PaymentController::class, 'CodPayment'])->name('payment.cod');




use App\Http\Controllers\pages\ProductDetailController;
use App\Http\Controllers\pages\IntroductionController;
use App\Http\Controllers\pages\NewController;
use App\Http\Controllers\pages\ContactController;


// sản phẩm
Route::get('/products', [ProductDetailController::class, 'index'])->name('product');
Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show');


// trang giới thiệu
Route::get('/introduce', [IntroductionController::class, 'index'])->name('introduce');

//trang tin tức
Route::get('/news', [NewController::class, 'index'])->name('new');
Route::get('/news/{id}', [NewController::class, 'show'])->name('news.show');

//trang liên hệ
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');




