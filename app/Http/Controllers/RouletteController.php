<?php

namespace App\Http\Controllers;

use App\Models\Roulette;
use Illuminate\Http\Request;

class RouletteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rouletteResults = Roulette::select('id','photoURL','textContent')->get();
        $roulleteResultsCount = Roulette::all()->count();
        $randomizer = rand(1,$roulleteResultsCount);
        
        return response()->json([
            $rouletteResults,
            'result' => $randomizer,
        ]);
        
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
