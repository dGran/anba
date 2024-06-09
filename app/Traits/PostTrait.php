<?php

namespace App\Traits;

use App\Models\Post;
use Illuminate\Support\Str;

trait PostTrait
{
    public function storePost(
        string $type,
        string $category,
        string $title,
        string $description,
        ?string $img = null,
        ?int $match_id = null,
        ?int $statement_id = null,
        ?int $transfer_id = null,
        ?int $player_id = null,
        ?int $team_id = null
    ): Post {
        return Post::create([
            'type' => $type,
            'match_id' => $match_id,
            'statement_id' => $statement_id,
            'transfer_id' => $transfer_id,
            'player_id' => $player_id,
            'team_id' => $team_id,
            'category' => $category,
            'title' => $title,
            'description' => $description,
            'img' => $img,
            'slug' => Str::slug($title, '-')
        ]);
    }
}
