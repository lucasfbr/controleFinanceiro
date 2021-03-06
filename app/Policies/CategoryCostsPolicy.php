<?php

namespace App\Policies;

use App\User;
use App\CategoryCost;
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

    public function owner(User $user, CategoryCost $categoryCosts){

        return $user->id == $categoryCosts->user_id;

    }
}
