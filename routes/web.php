<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Models\Post;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

   $posts = Post::all();
   // pass the collection result to the posts view
    return view('posts', ['posts' => $posts]);
});


Route::get('posts/{post}', function ($slug) {

    $post = Post::find($slug);

    return view('post', ['post' => $post]);
})->where('post', '[a-zA-Z_\-]+');
