<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;


class UserService
{
    /**
     *Generate unique link for free spins
     */
    public static function generateFreespinLink()
    {
        $link = Str::random(40);

        return $link;
    }

    public static function startFreespinSession($user)
    {
        Session::put('freespin_user', [ 'username' => $user->username,
                                        'phonenumber' => $user,
                                        'link' => $user->link
            ],
            60 * 24 * 7);
    }
}
