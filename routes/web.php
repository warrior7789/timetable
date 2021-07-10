<?php

use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\TimetableController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('timetable',[TimetableController::class, 'index'])->middleware('auth')->name('timetable');
Route::get('timetablelist',[TimetableController::class, 'timetablelist'])->middleware('auth')->name('timetablelist');

Route::post('submitpartone',[TimetableController::class, 'submitpartone'])->middleware('auth')->name('submitpartone');
Route::post('submitparttwo',[TimetableController::class, 'submitparttwo'])->middleware('auth')->name('submitparttwo');
Route::post('createtitmetable',[TimetableController::class, 'createtitmetable'])->middleware('auth')->name('createtitmetable');
//Route::post('submitpartone',[Timetable::class, 'submitpartone'])->middleware('auth')->name('submitpartone');