<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RewieController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderServiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ServiceRequestController;
use App\Model\Category;
use App\Model\Product;
use App\Model\Service;
use App\Model\User;


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


Route::get('/', function () {
    return view('startMain');
});

// ======================     adminpanel     ========================

Route::group(['middleware'=>['auth']], function(){

    Route::get('/dashboard', [Controller::class, 'dashboard'])->name('dashboard');// переход в adminpanel

    Route::middleware('manager')->group(function() {

        //---------- categories ---------------
        Route::get('/categorylist', [CategoryController::class, 'index']); // список
        Route::get('/addcategory', [CategoryController::class, 'create']); // ввод новой
        Route::post('/addcategory', [CategoryController::class, 'store']); // запись в БД
        Route::get('/editcategory/{category}',  [CategoryController::class,'edit']); // редактирование
        Route::post('/editcategory/{category}',  [CategoryController::class,'update']); // запись изменений в БД
        Route::delete('/deletecategory/{category}', [CategoryController::class, 'destroy']); // удаление  в БД

        //---------- products ---------------
        Route::get('productlist', [ProductController::class, 'indexAdmin']); //список продуктов - вывод на страницу
        Route::post('/productByCategory', [ProductController::class, 'productByCategory1']);//список продуктов по выбранной категории
        Route::get('/addproduct', [ProductController::class, 'create']); // ввод нового
        Route::post('/addproduct', [ProductController::class, 'store']); // запись в БД
        Route::get('/editproduct/{product}', [ProductController::class, 'edit']); // редактирование
        Route::post('/editproduct/{product}', [ProductController::class, 'update']); // запись изменений в БД
        Route::get('/deleteproduct/{product}', [ProductController::class, 'destroy']);// удаление. преход на подтверждение
        Route::post('/deleteproduct/{product}', [ProductController::class, 'delete']);// удаление  в БД

        //---------- services ---------------
        Route::get('/servicelist', [ServiceController::class, 'adminIndex']); //список услуг - вывод на страницу
        Route::get('/addservice', [ServiceController::class, 'create']); // ввод новой услуги
        Route::post('/addservice', [ServiceController::class, 'store']); // запись в БД
        Route::get('/editservice/{service}', [ServiceController::class, 'edit']); // редактирование
        Route::post('/editservice/{service}', [ServiceController::class, 'update']); // запись изменений в БД
        Route::delete('/deleteservice/{service}', [ServiceController::class, 'destroy']); // удаление в БД

        //---------- servise orders (на услуги) ---------------
        Route::get('/adminserviceorders', [ServiceController::class, 'serviceorderlist']); //список - вывод на страницу
        Route::get('/adminserviceorderdetails/{orderservice}',[ServiceController::class,'aserviceorderdetails']); //просмотр строк ордера(на услуги)
        Route::get('/addserviceorder/{serviceRequest}', [ServiceController::class, 'createServiceOrder']); // формирование ордера по заявке
        Route::post('/addserviceorder/{serviceRequest}', [ServiceController::class, 'storeServiceOrder']); //запись ордера в БД

        //---------- servise requests ---------------
        Route::get('/servicerequests', [ServiceRequestController::class, 'index']); // список заявок на услуги (ремонт)

        //---------- orders (на товары) ---------------
        Route::get('/orderlist', [OrderController::class, 'adminOrder']); //список - вывод на страницу
        Route::get('/admindetails/{order}',[OrderController::class,'admindetails']); //просмотр строк ордера(на товары)
    });

    Route::middleware('admin')->group(function() {
        //---------- users ---------------
        Route::get('users', [UserController::class, 'index']); //список пользователей
        Route::post('/userByRole', [UserController::class, 'userByrole']); //list users by role
        Route::get('/adduser', [UserController::class, 'create']); //ввод данных нового пользователя
        Route::post('/adduser', [UserController::class, 'store']); //запись в БД нового пользователя
        Route::get('/edituser/{user}', [UserController::class, 'edit']); //изменение данных пользователя
        Route::post('/edituser/{user}', [UserController::class, 'update']); //запись изменений в БД
    });

});

//----------------------------------------------------------------------------------------------

//adminpanel. редактирование профиля
Route::get('/profile/{user}', [UserController::class,'edit']); //изменение данных
Route::post('/profile/{user}', [UserController::class,'update']);//запись изменений в БД

//-------------login-----------------------------
Route::get('/login', [AuthController::class, 'login'])->name('login');//заполнение формы Login
Route::post('/login', [AuthController::class, 'authenticate']); // обработка формы
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');//выход пользователя из аутентификации
//------------------register---------------------
Route::get('/register', [UserController::class, 'register']);//заполнение формы Register(регистрация пользователя)
Route::post('/register', [UserController::class, 'userStore']);//запись в БД


// ======================     mainSite     ========================

//------------------------------------------------------------------------------------------------

//Работа с меню Services
Route::get('/services', [ServiceController::class, 'index']); //список услуг

//------------------------------------------------------------------------------------------------

//Работа с меню Catalog
Route::get('/catalog', [ProductController::class, 'index']); //список всех продуктов
Route::get('/categoryproducts/{category}', [ProductController::class,'productByCategory']);//список продуктов по выбранной категории
Route::get('/show/{product}', [ProductController::class, 'show'])->name('task.show');//просмотр детальной инф-ции по продукту
Route::get('/search', [ProductController::class, 'search']);//
//------------------------------------------------------------------------------------------------

//Добавление отзыва о продукте (table rewiews)
Route::post('/rewiews', [RewieController::class,'store'])->name('rewiews.store');

//-----------------------------------------------------------------------------------------------

//Работа с формой Contact
Route::get('/contact', function () { // заполнение данных формы
    return view('contact/index');
});
Route::post('/contact', [ServiceRequestController::class,'store']);//запись в БД

// -----------------------------------------------------------------------------------------------

// account (кабинет пользователя)
//(доступно для аутентифицировавшегося пользователя)
Route::get('/account/{user}', [UserController::class, 'account']);// вход в аккаунт
Route::post('/account/{user}', [UserController::class, 'editaccount']);//редактирование профиля
Route::get('/orders',[OrderController::class,'index']); //просмотр списка ордеров на товары
Route::get('/orderdetails/{order}',[OrderController::class,'details']);//просмотр строк ордера(на товары)
Route::get('/serviceorders',[OrderServiceController::class,'index']); //просмотр списка ордеров на услуги
Route::get('/serviceorderdetails/{serviceorders}',[OrderServiceController::class,'details']);//просмотр строк ордера(на услуги)

//-------------------------------------------------------------------------------------------------

// Формирование ордера(order) на продукты
Route::get('/checkout', [ProductController::class, 'checkout']);//предварительная форма ордера
Route::post('/addorder', [OrderController::class, 'store']);//запись ордера в БД

//--------------------------------------------------------------------------------------------------

// Работа с корзиной(cart)
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');//просмотр содержимого корзины
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');//добавить продукт в корзину
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');//корректировка данных
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');//удаление строки

//---------------------------------------------------------------------------------------------------


//Route::get('/cart', [ProductController::class, 'cart']);

//Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

//Route::post('/serviceorderdetails/{serviceorders}',[OrderServiceController::class,'update']);

// Route::get('/editservicereq/{serviceRequest}', [ServiceRequestController::class, 'edit']);
// Route::post('/editservicereq/{serviceRequest}', [ServiceRequestController::class, 'update']);
