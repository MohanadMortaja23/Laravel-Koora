<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ConversationController;
use App\Http\Controllers\Api\FlagController;
use App\Http\Controllers\Api\GeneralTeamController;
use App\Http\Controllers\Api\GlobalTeamController;
use App\Http\Controllers\Api\LocalTeamController;
use App\Http\Controllers\Api\NationalTeamController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ReactionController;
use App\Http\Controllers\Api\ReelsController;
use App\Http\Controllers\Api\TeamController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\VoteController;
use App\Http\Resources\TopResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Route;
use App\Traits\ApiTrait;
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



Route::post('login', [AuthController::class , 'Login']);
Route::post('register', [AuthController::class , 'Register']);
Route::post('social_login',[AuthController::class,'socialLogin']);

Route::post('auto-register', [AuthController::class , 'AutoRegister']);


Route::post('reset-password' , [AuthController::class , 'ResetPassword']);

// Route::get('email/verify/{id}', [AuthController::class, 'verify'])->name('verification.verify');

Route::middleware(['auth:sanctum'])->group( function() {
    Route::post('my-info', [AuthController::class , 'Information']);

    Route::get('local-teams', [TeamController::class , 'Local']);
    Route::get('global-teams', [TeamController::class , 'Global']);
    Route::get('national-teams', [TeamController::class , 'national']);
    Route::post('suggest-team', [TeamController::class , 'Suggest']);

    
    Route::post('select-local', [TeamController::class , 'SelectLocalTeam']);
    Route::post('select-global', [TeamController::class , 'SelectGlobalTeam']);
    Route::post('select-national', [TeamController::class , 'SelectNationalTeam']);

    Route::get('selected-teams', [TeamController::class , 'SelectedTeams']);


    Route::apiResource('profile' , ProfileController::class);
    Route::post('delete-account' , [ProfileController::class , 'DeleteAccount']);


    Route::apiResource('local-conversation' , LocalTeamController::class);
    Route::apiResource('global-conversation' , GlobalTeamController::class);
    Route::apiResource('national-conversation' , NationalTeamController::class);
    Route::apiResource('general-conversation' , GeneralTeamController::class);
    
    Route::post('like' , [ReelsController::class , 'AddLike']);



    Route::apiResource('comments' , CommentController::class);
    Route::apiResource('vote' , VoteController::class);

    Route::apiResource('reals' , ReelsController::class);

    Route::post('post-reaction' ,[ ReactionController::class , 'PostReaction']);


    Route::apiResource('notifications' , NotificationController::class);

    Route::post('update-password', [ProfileController::class, 'updatePassword']);

    Route::post('report' , [FlagController::class , 'Report']);
    Route::post('block' , [FlagController::class , 'BlockUser']);

    Route::post('/refresh_device_token', [AuthController::class, 'RefreshDeviceToken']);

});
Route::apiResource('reals' , ReelsController::class);

Route::apiResource('posts' , PostController::class);

Route::get('top-ten', function () {

    return Response()->Json([
        'status' => true,
        'code' => 200,
        'message' => 'Data Return Successfully',
        'data' => TopResource::collection(User::select('name' , 'image' , 'points')->orderBy('points' , 'DESC')->limit(10)->get()),
    ], 200);



  
});