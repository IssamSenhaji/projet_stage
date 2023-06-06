<?php

use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\EtudiantsController;
use App\Http\Controllers\FormateursController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
s
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\GroupesController;




use App\Models\Etudiants;
use App\Models\Formateurs;

use App\Models\Groupes;



use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();
Route::post('/etudiants2', [EtudiantsController::class,'store']);

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', function () {
        $formations=count(Formations::all());
        $matieres=count(Matieres::all());
        $groupes=count(Groupes::all());
        $etudiants=count(Etudiants::all());
        $formateurs=count(Formateurs::all());
        $tdtp=count(TdTp::all());
        $videos=count(Videos::all());
        return view('index',compact('formations','matieres','groupes','etudiants','formateurs','tdtp','videos'));
    });

    Route::resource('users', UserController::class);

    Route::resource('matieres', MatieresController::class);
    Route::resource('groupes', GroupesController::class);
    Route::resource('etudiants', EtudiantsController::class);

    Route::resource('formateurs', FormateursController::class);



    Route::get('/profil', [UserController::class,'profil']);

    //documents routes--------------------------//
    Route::get('/documents/{folder?}', [DocumentsController::class,'index'])->name('documents.index');
    Route::post('/documents/addfolder/{folder?}', [DocumentsController::class,'addfolder'])->name('documents.addfolder');
    Route::post('/documents/upload/{folder?}', [DocumentsController::class,'upload'])->name('documents.upload');
    Route::post('/documents/couper/{folder?}', [DocumentsController::class,'couper'])->name('documents.couper');
    Route::post('/documents/delete/{folder?}', [DocumentsController::class,'delete'])->name('documents.delete');
    Route::post('/documents/rename/{folder?}', [DocumentsController::class,'rename'])->name('documents.rename');
});

Route::get('/migrate', function(){
    Artisan::call('migrate');
    dd('Migrated done!');
});
Route::get('/seed', function(){
    Artisan::call('db:seed');
    dd('Seed done!');
});
