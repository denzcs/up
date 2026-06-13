<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post("/logout", [AuthController::class, "logout"]);
    Route::post("/favorite/{id}", [FavoriteController::class, "create"]);
    Route::get("/favoriteDelete/{id}", [FavoriteController::class, "destroy"]);
    Route::get("/favoritesUser", [FavoriteController::class, "show"]);
    Route::post("/ingredient", [IngredientController::class, "store"]);
    Route::post("/category", [CategoryController::class, "store"]);
    Route::post("/recipe", [RecipeController::class, "store"]);
    Route::post("/recipe/{recipe}", [RecipeController::class, "update"]);
    Route::delete("/recipe/{recipe}", [RecipeController::class, "destroy"]);
    Route::delete("/ingredient/{ingredient}", [IngredientController::class, "destroy"]);
    Route::get("/ingredient/{ingredient}", [IngredientController::class, "show"]);
    Route::post("/ingredient/{ingredient}", [IngredientController::class, "update"]);
    Route::post("/recipeIngredient", [IngredientController::class, "storeRecipeIngredient"]);
    Route::get("/recipeIngredient/{recipe}", [IngredientController::class, "indexRecipeIngredient"]);
    Route::delete("/recipeIngredient/{recipeIngredient}", [IngredientController::class, "destroyRecipeIngredient"]);
    Route::delete("/category/{category}", [CategoryController::class, "destroy"]);
    Route::post('/UserStep/{recipe_id}', [UserController::class, 'UserStep']);
    Route::get('/LoadStep/{recipe_id}', [UserController::class, 'LoadStep']);
});
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::get("/recipe", [RecipeController::class, "index"]);
Route::get("/recipe/{recipe}", [RecipeController::class, "show"]);

Route::get("/category", [CategoryController::class, "index"]);
Route::get("/ingredient", [IngredientController::class, "index"]);
// Route::get("/category/{category}", [CategoryController::class, "show"]);
Route::get("/recipeDetail/{id}", [RecipeController::class, "recipeDetail"]);
Route::get('/recipeIngredient/{recipe_id}', [IngredientController::class, 'getRecipeIngredient']);