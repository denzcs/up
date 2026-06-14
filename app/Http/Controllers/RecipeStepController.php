<?php

namespace App\Http\Controllers;

use App\Models\RecipeStep;
use App\Models\Recipe;
use App\Http\Requests\StoreRecipeStepRequest;
use App\Http\Requests\UpdateRecipeStepRequest;
use Illuminate\Support\Facades\Storage;

class RecipeStepController extends Controller
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
    public function store(StoreRecipeStepRequest $request, Recipe $recipe)
    {
        $step = new RecipeStep();
        $step->recipe_id = $recipe->id;
        $step->step_number = $request->step_number;
        $step->description = $request->description;
        if ($request->photo) {
            $photo = Storage::disk("public")->putFile('/images', $request->photo);
            $step->image = $photo;
        }
        $step->save();
        return response()->json(['message' => 'ok', $step]);
    }
    public function stepNumberUpdate(StoreRecipeStepRequest $request, RecipeStep $step){
        $updatedStep = RecipeStep::where('id', $step->id)->first();
        $updatedStep->step_number = (string)($request->step_number - 1);
        $updatedStep->description = $request->description;
        $updatedStep->save();
        return response()->json();
    }
    /**
     * Display the specified resource.
     */
    public function show(RecipeStep $step)
    {
        $step = RecipeStep::where('id',$step->id)->first();
        return response()->json($step);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RecipeStep $recipeStep)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeStepRequest $request, RecipeStep $step)
    {
        $step->description = $request->description;
        if ($request->photo) {
            $photo = Storage::disk("public")->putFile('/images', $request->photo);
            $step->image = $photo;
        }
        $step->save();
        return response()->json(['message' => 'ok', $step]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RecipeStep $step)
    {
        return response()->json($step->delete());
    }
}
