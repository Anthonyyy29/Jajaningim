<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class HomeController extends Controller
{
    public function home()
    {
        $games = Game::all();
        return view('home', compact('games'));
    }
}
