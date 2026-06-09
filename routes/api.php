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
    Route::post('/UserStep/{recipe_id}', [UserController::class, 'UserStep']);
    Route::get('/LoadStep/{recipe_id}', [UserController::class, 'LoadStep']);
});
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::post("/recipesHome", [RecipeController::class, "recipesHome"]);
Route::get("/categoriesHome", [CategoryController::class, "categoriesHome"]);
Route::get("/recipeDetail/{id}", [RecipeController::class, "recipeDetail"]);
Route::get('/recipeIngredient/{recipe_id}', [IngredientController::class, 'getRecipeIngredient']);