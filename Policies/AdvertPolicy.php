<?php

namespace App\Policies;

use App\Advert;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvertPolicy
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


    public function update(User $user,Advert $advert){

        return auth()->check() && $user->hasVerifiedEmail() && $advert->user_id == auth()->id();

    }

    public function delete(User $user,Advert $advert){

        return auth()->check() && $user->hasVerifiedEmail() && $advert->user_id == auth()->id();

    }

    public function mark(User $user,Advert $advert){

        return auth()->check() &&  $advert->user_id != auth()->id();

    }

}
