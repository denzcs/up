<?php

namespace App\Http\Controllers;


use App\Models\Recipe;
use App\Http\Requests\StoreFavoriteRequest;
use App\Http\Requests\UpdateFavoriteRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteController extends Controller
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
    public function create(Recipe $recipe)
    {
        
        $favorite = Favorite::where('recipe_id', $recipe->id)->where('user_id', Auth::id())->first();
        if ($favorite) {
            $favorite->delete();
            $isLiked = false;
        } else {
            Favorite::create(['user_id' => Auth::id(), 'recipe_id' => $recipe->id]);
            $isLiked = true;
        }
        return response()->json([Favorite::where('recipe_id', $recipe->id)->where('user_id', Auth::id())->first(),'isLike'=>$isLiked]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFavoriteRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {

        return response()->json(Favorite::where('user_id', Auth::user()->id)->with('recipe.category')->paginate(3));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFavoriteRequest $request, Favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favorite $favorite)
    {
        //
    }
}
