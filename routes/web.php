<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;

Route::get('/', [UserController::class, 'index']);
Route::get('/login', [UserController::class, 'getLogin']);
Route::get('/logout', [UserController::class, 'logout']);
Route::get('/register', [UserController::class, 'getRegister']);
Route::post('/login', [UserController::class, 'postLogin']);
Route::post('/register', [UserController::class, 'postRegister']);

Route::get('/cart', [TransactionController::class, 'cart']);
Route::get('/download', [TransactionController::class, 'download']);
Route::get('/history', [TransactionController::class, 'history']);
Route::post('/buy-now', [TransactionController::class, 'buyNow']);
Route::post('/add-to-cart', [TransactionController::class, 'addToCart']);
Route::delete('/cancel-cart/{id}', [TransactionController::class, 'cancelCart']);
Route::post('/topup', [WalletController::class, 'topup']);
Route::put('/topup-accept/{id}', [WalletController::class, 'topupAccept']);
Route::put('/buy-from-cart', [TransactionController::class, 'buyFromCart']);

Route::post('/topup-from-bank', [WalletController::class, 'topupFromBank']);
Route::post('/withdrawal-from-user', [WalletController::class, 'withdrawUser']);
Route::post('/transfer-to-user', [WalletController::class, 'transferToUser']);
Route::put('/withdrawal-accept/{id}', [WalletController::class, 'withdrawAccept']);

Route::post('/post-user', [UserController::class, 'postUser']);
Route::put('/put-user/{id}', [UserController::class, 'putUser']);
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

Route::get('/roles', [RoleController::class, 'index']);
Route::post('/post-role', [RoleController::class, 'postRole']);
Route::put('/put-role/{id}', [RoleController::class, 'putRole']);
Route::delete('/delete-role/{id}', [RoleController::class, 'deleteRole']);

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/post-category', [CategoryController::class, 'postCategory']);
Route::put('/put-category/{id}', [CategoryController::class, 'putCategory']);
Route::delete('/delete-category/{id}', [CategoryController::class, 'deleteCategory']);

Route::post('/post-product', [ProductController::class, 'store']);
Route::put('/put-product/{id}', [ProductController::class, 'update']);
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy']);
