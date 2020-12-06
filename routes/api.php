<?php

use App\Http\Controllers\API\LocationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/locations', LocationController::class);
});

Route::post('/signin', function (Request $request) {

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique',
        'avatar' => 'string',
        'google_provider_id' => 'required',
        'device_id' => 'required',
    ]);

    $user = User::firstOrCreate(
        [
            'email' => $request->email,
            'google_provider_id' => $request->google_provider_id
        ],
        [
            'name' => $request->name,
            'user_type' => 'USER',
            'profile_photo_path' => $request->avatar,
        ]
    );

    return $user->createToken($request->device_id)->plainTextToken;
});