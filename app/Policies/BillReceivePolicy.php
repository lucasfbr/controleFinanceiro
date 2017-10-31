<?php

namespace App\Policies;

use App\User;
use App\BillReceive;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillReceivePolicy
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

    public function owner(User $user, BillReceive $billReceive){

        return $user->id == $billReceive->user_id;

    }
}
