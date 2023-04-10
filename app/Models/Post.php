<?php


namespace App\Models;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Post
{
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;

    }
    public static function find($slug){


    if(! file_exists($path =resource_path("posts/{$slug}.html"))){
        // return redirect('/');
        throw new ModelNotFoundException;
    }

    return cache()->remember("posts.{$slug}", 5, fn() => file_get_contents($path));

    }
    public static function all(){

    // collect an array and wrap within a collection object
    return collect(File::files(resource_path("posts"))) // find all the files in posts directory and collect them into a collection

        ->map(fn ($file) => YamlFrontMatter::parseFile($file->getPathname())) // loop or map over each item, then parse each one into a document.
        // map over each document, then build the post object by assign each value to the corresponding attribute.
        ->map(fn ($doc) => new Post(
            $doc->title,
            $doc->excerpt,
            $doc->date,
            $doc->body,
            $doc->slug
        ));
    }
}

