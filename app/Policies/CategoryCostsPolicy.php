<?php

namespace App\Policies;

use App\User;
use App\CategoryCosts;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryCostsPolicy
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

    public function owner(User $user, CategoryCosts $categoryCosts){

        return $user->id == $categoryCosts->user_id;

    }
}
