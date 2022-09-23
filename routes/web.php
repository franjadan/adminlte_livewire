<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\{PostComponent, UserComponent};

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

Route::get('/', function(){
    return redirect()->route('posts');
})->name('index');

Route::group(['middleware' => ['auth']], function() {
    Route::get('/posts', PostComponent::class)->name('posts');
    Route::get('/usuarios', UserComponent::class)->name('users');
});

Auth::routes();

