<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $user = User::add($request->all());
        UserService::startFreespinSession($user);

        return redirect( env('APP_URL') . '/freespins/' . $user->link);
    }
}
