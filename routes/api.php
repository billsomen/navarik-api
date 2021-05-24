<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\Simulator as Simulator;

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


Route::put('/zoo/add-time', function () {
    $simulator = Simulator::getInstance();
    $zoo = $simulator->getZoo();

    $zoo->load();
    $zoo->incrementTime();
    $response = $zoo->save();

    return response()->json(['zoo' => $response]);
});

Route::put('/zoo/animals/feed', function () {
    $simulator = Simulator::getInstance();
    $zoo = $simulator->getZoo();

    $zoo->load();
    $zoo->feedAnimals();
    $response = $zoo->save();

    return response()->json(['zoo' => $response]);
});

Route::delete('/zoo', function () {
    $simulator = Simulator::getInstance();
    $simulator->initializeZoo();
    $zoo = $simulator->getZoo();

    $response = $zoo->save();

    return response()->json(['zoo' => $response]);
});
