<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Repositories\BaseRepository;

class UserRepo extends BaseRepository implements UserRepoInterface
{
    public function getModel()
    {
        return User::class;
    }
}