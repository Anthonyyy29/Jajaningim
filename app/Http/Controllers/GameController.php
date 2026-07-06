<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // // // // // // // // // //
    // CONTROLLER UNTUK PUBLIC //
    // // // // // // // // // //
    

    // Menampilkan semua game yang aktif untuk PUBLIC
    public function index()
    {
        $games = Game::where('is_active', 'true')->get();
        return view('pages.allgames', compact('games'));
    } 
    public function populerIndex()
    {
        $games = Game::where('is_active', 'true')->get();
        return view('pages.home', compact('games'));
    } 


    // Menampilkan detail game tertentu untuk PUBLIC
    public function show($id)
    {
        $game = Game::findOrFail($id);
        $paymentMethods = PaymentMethod::where('is_active', 'true')->get();
        return view('pages.game', compact('game', 'paymentMethods'));
    }
    
    
    // // // // // // // // // //
    // CONTROLLER UNTUK ADMIN  //
    // // // // // // // // // //
    
    // Menampilkan semua game yang aktif untuk ADMIN
    public function indexAdmin()
    {
        $games = Game::where('is_active', 'true')->get();
        return view('pages.home', compact('games'));
    }

    // Menampilkan detail game tertentu untuk ADMIN
    public function showAdmin($id)
    {
        // show detail game
        $game = Game::findOrFail($id);
        return view('pages.game', compact('game'));
    }






    
    public function create()
    {
        //
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Game $game)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Game $game)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Game $game)
    {
        //
    }
}
