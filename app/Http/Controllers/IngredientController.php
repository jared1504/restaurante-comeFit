<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientStoreRequest;
use App\Http\Requests\IngredientUpdateRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $ingredients = Ingredient::all();

        return view('ingredient.index', compact('ingredients'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('ingredient.create');
    }

    /**
     * @param \App\Http\Requests\IngredientStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(IngredientStoreRequest $request)
    {
        $ingredient = Ingredient::create($request->validated());

        $request->session()->flash('message', "Ingrediente registrado con éxito");
        $request->session()->flash('type', 'success');

        return redirect()->route('ingredient.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ingredient $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Ingredient $ingredient)
    {
        return view('ingredient.show', compact('ingredient'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ingredient $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Ingredient $ingredient)
    {
        return view('ingredient.edit', compact('ingredient'));
    }

    /**
     * @param \App\Http\Requests\IngredientUpdateRequest $request
     * @param \App\Models\Ingredient $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(IngredientUpdateRequest $request, Ingredient $ingredient)
    {
        $ingredient->update($request->validated());

        $request->session()->flash('message', "Ingrediente Actualizado con Éxito");
        $request->session()->flash('type', 'success');

        return redirect()->route('ingredient.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Ingredient $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Ingredient $ingredient)
    {
        $ingredient->delete();

        return redirect()->route('ingredient.index');
    }
}
