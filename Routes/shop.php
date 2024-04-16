<?php
use Illuminate\Support\Facades\Route;
use Plugin\NoPay\Controllers\CallbackController;

Route::post('/callback/no_pay/order_status', [CallbackController::class, 'orderStatus'])->name('no_pay.order_status');
