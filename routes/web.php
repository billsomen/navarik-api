<?php

use Illuminate\Support\Facades\Route;
use \App\Models\Simulator as Simulator;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    $simulator = Simulator::getInstance();
    $zoo = $simulator->getZoo();
    $response = $zoo->load();

    return view('zoo', ['zoo' => $response]);
});
