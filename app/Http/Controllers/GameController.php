<?php

namespace App\Http\Controllers;
use App\Models\Game;

use Illuminate\Http\Request;

class GameController extends Controller
{
    // BELUM DIPAKAI KARENA AUTENTIKASI BELUM DI SETUP
    // public function adminIndex()
    // {
    //     // index untuk admin, tanpa filter
    //     $games = Game::all();
    //     return view('pages/admin/games', compact('games'));
    // } 
    
    public function index()
    {
        // index untuk publik
        $games = Game::where('is_active', 'true')->get();
        return view('pages.home', compact('games'));
    }
    
    public function AllGamesIndex()
    {
        // index untuk publik
        $games = Game::where('is_active', 'true')->get();
        return view('pages.allgames', compact('games'));
    }

    
    public function show($id)
    {
        // show detail game
        $game = Game::findOrFail($id);
        return view('pages.game'.$id, compact('game'));
    }

    
}
