<?php

namespace App\Policies;

use App\User;
use App\BillPay;
use Illuminate\Auth\Access\HandlesAuthorization;

class BillPayPolicy
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

    public function owner(User $user, BillPay $billPay){

        return $user->id == $billPay->user_id;

    }
}
