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

    // collect an array and wrap within a collection object
    $posts = collect(File::files(resource_path("posts"))) // find all the files in posts directory and collect them into a collection

        ->map(fn ($file) => YamlFrontMatter::parseFile($file->getPathname())) // loop or map over each item, then parse each one into a document.
        // map over each document, then build the post object by assign each value to the corresponding attribute.
        ->map(fn ($doc) => new Post(
            $doc->title,
            $doc->excerpt,
            $doc->date,
            $doc->body,
            $doc->slug
        ));
   // pass the collection result to the posts view
    return view('posts', ['posts' => $posts]);
});


Route::get('posts/{post}', function ($slug) {

    $post = Post::find($slug);

    return view('post', ['post' => $post]);
})->where('post', '[a-zA-Z_\-]+');
