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

    $files = File::files(resource_path("posts"));
    $posts = [];
    // dd($files);
    foreach($files as $file){
    // dd($file->getPathname());
    $doc = YamlFrontMatter::parseFile(
        // $file->getPathname()
        resource_path($file)
    );
    $posts[] = new Post(
        $doc->title,
        $doc->excerpt,
        $doc->date,
        $doc->body,
        $doc->slug
    );
    // dd($doc->title);
    return view('posts',[

        'posts' =>$posts
    ]);
    }

});


Route::get('posts/{post}', function($slug){

    $post = Post::find($slug);

    return view('post',['post' => $post]);
})->where('post', '[a-zA-Z_\-]+');
