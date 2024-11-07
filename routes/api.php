<?php

use App\Http\Controllers\Api\ChurchController;
use App\Http\Controllers\Api\ChurchEventController;
use App\Http\Controllers\Api\GroupController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\OccupationController;
use App\Http\Controllers\Api\RelationshipController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorkplaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(ChurchController::class)
    ->prefix('church')
    ->group(function () {
        Route::get('/list', 'getChurches');
        Route::post('/create', 'createChurch');
        Route::whereNumber('church')->group(function () {
            Route::get('/{church}', 'showChurch');
            Route::put('/{church}/update', 'updateChurch');
            Route::delete('/{church}/delete', 'deleteChurch');
        });
    });

Route::controller(ChurchEventController::class)
    ->prefix('church-event')
    ->group(function () {
        Route::get('/list', 'getAllChurchEvents');
        Route::post('/create', 'createChurchEvent');
        Route::whereNumber('churchEvent')->group(function () {
            Route::get('/{churchEvent}', 'showChurchEvent');
            Route::put('/{churchEvent}/update', 'updateChurchEvent');
            Route::delete('/{churchEvent}/delete', 'deleteChurchEvent');
        });
    });

Route::controller(GroupController::class)
    ->prefix('group')
    ->group(function () {
        Route::get('/list', 'getAllGroups');
        Route::post('/create', 'createGroup');
        Route::whereNumber('group')->group(function () {
            Route::get('/{group}', 'showGroup');
            Route::put('/{group}/update', 'updateGroup');
            Route::delete('/{group}/delete', 'deleteGroup');
        });
    });

Route::controller(MemberController::class)
    ->prefix('member')
    ->group(function () {
        Route::get('/list', 'getAllMembers');
        Route::post('/create', 'createMember');
        Route::whereNumber('member')->group(function () {
            Route::get('/{member}', 'showMember');
            Route::put('/{member}/update', 'updateMember');
            Route::delete('/{member}/delete', 'deleteMember');
        });
    });

Route::controller(OccupationController::class)
    ->prefix('occupation')
    ->group(function () {
        Route::get('/list', 'getAllOccupations');
        Route::post('/create', 'createOccupation');
        Route::whereNumber('occupation')->group(function () {
            Route::get('/{occupation}', 'showOccupation');
            Route::put('/{occupation}/update', 'updateOccupation');
            Route::delete('/{occupation}/delete', 'deleteOccupation');
        });
    });


Route::controller(RelationshipController::class)
    ->prefix('relationship')
    ->group(function () {
        Route::get('/list', 'getAllRelationships');
        Route::post('/create', 'createRelationship');
        Route::whereNumber('relationship')->group(function () {
            Route::get('/{relationship}', 'showRelationship');
            Route::put('/{relationship}/update', 'updateRelationship');
            Route::delete('/{relationship}/delete', 'deleteRelationship');
        });
    });

Route::controller(UserController::class)
    ->prefix('user')
    ->group(function () {
        Route::get('/list', 'getAllUsers');
        Route::post('/create', 'createUser');
        Route::whereNumber('user')->group(function () {
            Route::get('/{user}', 'showUser');
            Route::put('/{user}/update', 'updateUser');
            Route::delete('/{user}/delete', 'deleteUser');
        });
    });

Route::controller(WorkplaceController::class)
    ->prefix('workplace')
    ->group(function () {
        Route::get('/list', 'getAllWorkplace');
        Route::post('/create', 'createWorkplace');
        Route::whereNumber('workplace')->group(function () {
            Route::get('/{workplace}', 'showWorkplace');
            Route::put('/{workplace}/update', 'updateWorkplace');
            Route::delete('/{workplace}/delete', 'deleteWorkplace');
        });
    });
