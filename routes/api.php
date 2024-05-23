<?php

use App\Http\Controllers\DigitalVirgoController;
use App\Http\Controllers\PaydunyaController;
use App\Http\Controllers\WebpurifyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix("/digital-virgo")->group(function () {
    Route::post("return", [DigitalVirgoController::class, 'getReturnPayment']);
    Route::post("generate", [DigitalVirgoController::class, 'generatePayUrl']);
    Route::post("notify", [DigitalVirgoController::class, 'notifyPayment']);
});


Route::prefix("/paydunya")->group(function () {
    Route::post("initialpay", [PaydunyaController::class, 'initialPayment']);
    Route::post("status", [PaydunyaController::class, 'getPaymentNotification']);
    Route::get("return", [PaydunyaController::class, 'getReturn']);
});

/** Webpurify callback Return Capture data response */ 
Route::get("/webpurify", [WebpurifyController::class, 'callbackReturnCapture']);
Route::post("/webpurify", [WebpurifyController::class, 'callbackReturnCapture']);

/** Rocketfuel callback Return Capture data response */ 
Route::get('/rocketfuel/callback-payment/capture-response', 'PaymentsController@callbackPaymentFromRocketFuel');
Route::post('/rocketfuel/callback-payment/capture-response', 'PaymentsController@callbackPaymentFromRocketFuel');