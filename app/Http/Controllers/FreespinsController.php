<?php

namespace App\Http\Controllers;

use App\Models\Freespin;
use App\Models\User;
use Illuminate\Http\Request;

class FreespinsController extends Controller
{
    public function index($link)
    {
        $user = User::where('link', $link)->first();

        return view('freespins', ['user' => $user]);
    }

    public function store(Request $request)
    {
        Freespin::create($request->all());
    }

    public function generateNewLink($link)
    {
        $user = User::where('link', $link)->first();
        $user->setLink();
        return redirect('/freespins/' . $user->link);
    }

    public function deactivateLink($link)
    {
        User::where('link', $link)->delete();

        return redirect('/');
    }

}
