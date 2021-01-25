<?php

namespace App\Http\Traits;

use App\Models\Post;
use Illuminate\Support\Str;

trait PostTrait {

    public function storePost($type, $match_id, $statement_id, $transfer_id, $category, $title, $description, $img) {
    	$post = Post::create([
	    	'type' => $type,
	    	'match_id' => $match_id,
	    	'statement_id' => $statement_id,
	    	'transfer_id' => $transfer_id,
	    	'category' => $category,
	    	'title' => $title,
	    	'description' => $description,
	    	'img' => $img,
	        'slug' => Str::slug($title, '-')
    	]);
        return $post;
    }

}