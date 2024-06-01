<?php

declare(strict_types=1);

namespace App\Manager;

use App\Models\Post;
use App\Repository\PostRepository;

class PostManager
{
    private PostRepository $repository;

    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int[] $matchIds
     *
     * @return int[]
     */
    public function findIdsByMatchIds(array $matchIds): array
    {
        return $this->repository->findIdsByMatchIds($matchIds);
    }

    /**
     * @param int[] $ids
     */
    public function deleteByIds(array $ids): void
    {
        Post::destroy($ids);
    }
}
