<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class AuthorService
{
    public function __construct(
        private UserRepository $repository
    )
    {
    }

    public function getAll(): Collection|array
    {
        return $this->repository->getAuthors();
    }
}
