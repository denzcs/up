<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\RecipeIngredient;
use App\Models\Recipe;
use App\Http\Requests\StoreIngredientRequest;
use App\Http\Requests\UpdateIngredientRequest;
use App\Http\Requests\RecipeIngredientRequest;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Ingredient::all());
    }
    public function indexRecipeIngredient(Recipe $recipe)
    {
        return response()->json(RecipeIngredient::where('recipe_id', $recipe->id)->with('ingredient')->get());
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
    public function store(StoreIngredientRequest $request)
    {
        return response()->json(Ingredient::create([
            'name' => $request->ingredient_name,
            'unit' => $request->unit,
        ]));
    }
    public function storeRecipeIngredient(RecipeIngredientRequest $request)
    {
        $ingredient = new RecipeIngredient();
        $ingredient->recipe_id = $request->recipe;
        $ingredient->ingredient_id = $request->ingredient;
        $ingredient->quantity = $request->quantity;
        $ingredient->save(); 
        return response()->json(['message' => 'ok']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredient $ingredient)
    {
        return response()->json($ingredient);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredient $ingredient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIngredientRequest $request, Ingredient $ingredient)
    {
        $ingredient->name=$request->ingredient_name;
        $ingredient->unit=$request->unit;
        $ingredient->save();
        return response()->json($ingredient);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredient $ingredient)
    {
        return response()->json($ingredient->delete());
    }
    public function destroyRecipeIngredient(recipeIngredient $recipeIngredient)
    {
        return response()->json($recipeIngredient->delete());
    }
}
