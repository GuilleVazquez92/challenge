<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\AttackTypesController;
use App\Http\Controllers\Api\V1\PlayerTypesController;
use App\Http\Controllers\Api\V1\ItemTypesController;
use App\Http\Controllers\Api\V1\PlayersController;
use App\Http\Controllers\Api\V1\AttacksController; 
use App\Http\Controllers\Api\V1\InventoriesController; 
use App\Http\Controllers\Api\V1\ItemsController;


###################      AUTH ROUTES             ######################
 
Route::post('/register',[AuthController::class, 'register'])->name('register');
Route::post('/login',[AuthController::class, 'login'])->name('login');
Route::post('/logout',[AuthController::class, 'logout'])->name('logout')->middleware('auth:api');;


###################      PLAYERS ROUTES         ######################

Route::resource('/player_types', PlayerTypesController::class)
->names('player_types')
->middleware(['auth:api','check.roles:admin']);

Route::resource('/players', PlayersController::class)
->names('players')
->middleware(['auth:api','check.roles:admin']);

###################     ATTACKS ROUTES           ######################

Route::resource('/attack_types', AttackTypesController::class)
->names('attack_types')
->middleware(['auth:api','check.roles:admin']);

Route::resource('/attacks', AttacksController::class)
->names('attacks')
->middleware(['auth:api','check.roles:player']);

Route::get('/check_ulti_attack', [AttacksController::class, 'checkUltiAttack'])
->name('check_attack')
->middleware(['auth:api','check.roles:admin']);


##############      ITEMS ROUTES                ######################

Route::resource('/item_types', ItemTypesController::class)
->names('item_types')
->middleware(['auth:api','check.roles:admin']);

Route::resource('/items', ItemsController::class)
->names('item')
->middleware(['auth:api','check.roles:admin']);

##############      INVENTORIES ROUTES                ######################

Route::resource('/inventories', InventoriesController::class)
->names('iventories')
->middleware(['auth:api','check.roles:player']);

##############        CONTROL ROUTES                ######################

Route::fallback(function () {
    return response()->json(['message' => 'the route does not exist.'], 404);
});