<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Recipe::with('category')->get());
    }

    public function Homerecipes(Request $request)
    {
        $sort = json_decode($request->sort);
        return response()->json(Recipe::with('category')->where(function ($query) use ($request) {
            if ($request->categories) {
                $cat = json_decode($request->categories);
                $query->whereIn('category_id', $cat);
            }
            if ($request->difficulty) {
                $query->where('difficulty', $request->difficulty);
            }
            if ($request->selectTime) {
                $time = json_decode($request->selectTime);
                $query->whereBetween('cook_time', $time);
            }
            if ($request->search) {
                $query->whereLike('title', '%' . $request->search . '%');
            }
        })->orderBy($sort->field, $sort->by)->paginate(6));
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
    public function store(StoreRecipeRequest $request)
    {
        $recipe = new Recipe();
        $recipe->title = $request->title;
        $recipe->category_id = $request->category;
        $recipe->recipe_description = $request->recipe_description;
        $recipe->cook_time = $request->cook_time;
        $recipe->difficulty = $request->difficulty;
        $photo = Storage::disk("public")->putFile('/images', $request->photo);
        $recipe->photo = $photo;
        $recipe->save(); 
        return response()->json(['message' => 'ok', 'id' => $recipe->id, $recipe]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        $recipe = Recipe::where('id',$recipe->id)->with(['category','steps'])->first();
        return response()->json($recipe);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $recipe->title = $request->title;
        $recipe->category_id = $request->category;
        $recipe->recipe_description = $request->recipe_description;
        $recipe->cook_time = $request->cook_time;
        $recipe->difficulty = $request->difficulty;
        if ($request->photo) {
            $photo = Storage::disk("public")->putFile('/images', $request->photo);
            $recipe->photo = $photo;
        }
        $recipe->save(); 
        return response()->json(['message' => 'ok', $recipe]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        return response()->json($recipe->delete());
    }
}
