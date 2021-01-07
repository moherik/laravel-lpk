<?php

use App\Http\Controllers\API\LocationController;
use App\Models\User;
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

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::apiResource('/locations', LocationController::class);

Route::post('/signin', function (Request $request) {

    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'avatar' => 'string',
        'google_provider_id' => 'required',
    ]);

    try {
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
    
        return response()->json(['token' => $user->createToken("login")->plainTextToken], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => true, 'message' => $e->getMessage()], 500);
    }
});