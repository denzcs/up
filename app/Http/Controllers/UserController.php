<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use App\Models\UserStep;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
     public function UserStep(Request $request, Recipe $recipe)
    {
        $step = UserStep::where('recipe_id', $recipe->id)->where('user_id', Auth::user()->id)->first();
        if ($step) {
            $step->step_number = $request->step_number;
        } else {
            $step = new UserStep();
            $step->step_number = $request->step_number;
            $step->recipe_id = $recipe->id;
            $step->user_id = Auth::user()->id;
        }
        $step->save();
        return response()->json($step);
    }
    public function LoadStep(Recipe $recipe)
    {
        $step = UserStep::where('recipe_id', $recipe->id)->where('user_id', Auth::user()->id)->first();
        return response()->json($step);
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
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
