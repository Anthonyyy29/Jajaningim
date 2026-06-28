<?php

namespace App\Http\Controllers;

use App\Models\GameItem;
use Illuminate\Http\Request;

class GameItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
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
     * Display the specified resource.
     */
    public function show(GameItem $gameItem)
    {
        //
        return view('game_items', compact('gameItem'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GameItem $gameItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GameItem $gameItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GameItem $gameItem)
    {
        //
    }
}
