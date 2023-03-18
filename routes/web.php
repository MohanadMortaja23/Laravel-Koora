<?php 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FlagController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\LocalController;
use App\Http\Controllers\Admin\NationalController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RealController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\GeneralTeamController;
use App\Http\Controllers\PendingTeamController;
use App\Http\Controllers\TestController;
use App\Http\Resources\MessageResource;
use App\Models\GlobalTeam;
use App\Models\Message;
use App\Models\NationalTeam;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

// use App\Traits\FcmTrait;
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

 Route::get('/', function () {
      return redirect()->route('dashboard.index');
  });
Route::get('email/verify/{id}', [AuthController::class, 'verify'])->name('verification.verify');


Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    // Mail::to('your_receiver_email@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    // dd("Email is Sent.");
});


Route::get('/test' , [TestController::class , 'sendFcm']);

Route::prefix('admin')->middleware(['auth:admin'])->group(function(){
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('glob-teams', GlobalController::class);
    Route::resource('locl-teams', LocalController::class);
    Route::resource('natio-teams', NationalController::class);
    Route::resource('suggests-team', PendingTeamController::class);
    Route::post('suggests/status', [PendingTeamController::class, 'status'])->name('suggests.status');
    Route::post('suggests/refuse', [PendingTeamController::class, 'refuse'])->name('suggests.refuse');

    Route::resource('users', UsersController::class);
    Route::post('user/status', [UsersController::class, 'status'])->name('user.status');

    Route::resource('reals', RealController::class);
    Route::resource('posts', PostController::class);
    Route::resource('flags', FlagController::class);

    Route::delete('messages/{id}',[ LocalController::class , 'MessageDestroy'])->name('messages.destroy');
    Route::delete('messages2/{id}',[ GlobalController::class , 'MessageDestroy'])->name('messages.destroy');
    Route::delete('messages3/{id}',[ NationalController::class , 'MessageDestroy'])->name('messages.destroy');

    Route::delete('messages4/{id}',[ GeneralTeamController::class , 'MessageDestroy'])->name('messages.destroy');

    Route::get('general-team',[ GeneralTeamController::class , 'showMessages'])->name('general-chat');


});
Route::prefix('admin')->name('admin.')->group(function(){
  require __DIR__.'/auth.php';

});
require __DIR__.'/auth.php';


Route::get('storage/{file}', function ($file) {
  $path = storage_path('app/public/' . $file);
  if (!is_file($path)) {
    abort(404);
  }
  return response()->file($path);
})->where('file', '.+');



