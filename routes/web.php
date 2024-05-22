<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [\App\Http\Controllers\AuthController::class,'login'])->name('auth.login');
Route::post('/login', [\App\Http\Controllers\AuthController::class,'doLogin']);
Route::delete('/logout', [\App\Http\Controllers\AuthController::class,'logout'])->name('auth.logout');

Route::prefix('/blog')->name('blog.')->controller(BlogController::class)->group(function () {

    Route::get('/', 'index')->name('index');

    Route::get('/new', 'create')->name('create')->middleware('auth');
    Route::post('/new', 'store')->middleware('auth');



    Route::get('/{post}/edit', 'edit')->name('edit')->middleware('auth');
    Route::patch('/{post}/edit', 'update')->middleware('auth');

    //     $post=App\Models\Post::create([

    //     'title'=>'Mon second article',
    //     'slug' =>'troisieme-article',
    //     'content' => 'Mon contenu',


    //    ]);

    //return App\Models\Post::paginate(25);


    //  return $post;

    Route::get('/{slug}-{post}', 'show')->where([



        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');


});

