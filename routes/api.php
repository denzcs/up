<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeStepController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::post("/favorite/{recipe}", [FavoriteController::class, "create"]);
    Route::get("/favoritesUser", [FavoriteController::class, "show"]);
    
    Route::post("/category", [CategoryController::class, "store"]);
    Route::delete("/category/{category}", [CategoryController::class, "destroy"]);

    Route::post("/recipe", [RecipeController::class, "store"]);
    Route::get("/recipe/{recipe}", [RecipeController::class, "show"]);
    Route::post("/recipe/{recipe}", [RecipeController::class, "update"]);
    Route::delete("/recipe/{recipe}", [RecipeController::class, "destroy"]);

    Route::post("/ingredient", [IngredientController::class, "store"]);
    Route::delete("/ingredient/{ingredient}", [IngredientController::class, "destroy"]);
    Route::get("/ingredient/{ingredient}", [IngredientController::class, "show"]);
    Route::post("/ingredient/{ingredient}", [IngredientController::class, "update"]);

    Route::post("/recipeIngredient", [IngredientController::class, "storeRecipeIngredient"]);
    
    Route::delete("/recipeIngredient/{recipeIngredient}", [IngredientController::class, "destroyRecipeIngredient"]);

    Route::get("/step/{step}", [RecipeStepController::class, "show"]);
    Route::post('/step/{recipe}', [RecipeStepController::class, 'store']);
    Route::post('/stepUpdate/{step}', [RecipeStepController::class, 'update']);
    Route::delete("/step/{step}", [RecipeStepController::class, "destroy"]);
    Route::post('/stepNumberUpdate/{step}', [RecipeStepController::class, 'stepNumberUpdate']);
    Route::get('/LoadStep/{recipe}', [UserController::class, 'LoadStep']);
    Route::post('/UserStep/{recipe}', [UserController::class, 'UserStep']);
});
Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);

Route::get("/category", [CategoryController::class, "index"]);

Route::post("/recipes", [RecipeController::class, "Homerecipes"]);
Route::get("/recipe", [RecipeController::class, "index"]);

Route::get("/recipeWOAuth/{recipe}", [RecipeController::class, "show"]);

Route::get("/ingredient", [IngredientController::class, "index"]);


Route::get("/recipeIngredient/{recipe}", [IngredientController::class, "indexRecipeIngredient"]);