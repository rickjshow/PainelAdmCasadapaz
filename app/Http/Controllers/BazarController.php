<?php

namespace App\Http\Controllers;

use App\Models\BannerBazar;
use Illuminate\Http\Request;

class BazarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $img = BannerBazar::all()->first();
        return view('bazar.index', compact('img'));
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
