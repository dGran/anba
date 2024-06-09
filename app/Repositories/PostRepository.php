<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Post;

class PostRepository
{
    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return Post::whereIn('match_id', $matchIds)->pluck('id')->toArray();
    }
}
