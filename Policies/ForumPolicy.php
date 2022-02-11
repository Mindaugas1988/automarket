<?php

namespace App\Policies;

use App\Forum;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ForumPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user){

        return auth()->check() && $user->hasVerifiedEmail();

    }
}
