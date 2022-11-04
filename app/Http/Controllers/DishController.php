<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\DishStoreRequest;
use App\Http\Requests\DishUpdateRequest;
use App\Models\Category;
use App\Models\DishIngredient;
use App\Models\Ingredient;

class DishController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $dishes = Dish::all();

        return view('dish.index', compact('dishes'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::all();
        $ingredients = Ingredient::where('id', '!=', 0)->orderBy('name')->get();
        return view('dish.create', compact('categories', 'ingredients'));
    }

    /**
     * @param \App\Http\Requests\DishStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*  dd($request); */
        /*  $dish = Dish::create($request->validated());

        $request->session()->flash('dish.id', $dish->id); */
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required',
            'cal' => 'required',
            'category_id' => 'required|numeric',
            'dishIngredients' => 'required|array',
            'dishIngredients.*' => 'numeric|nullable',
        ]);


        //guardar imagen
        $imagen = $request->file('image');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(500, 500);
        $imagenPath = public_path('img/dishes') . "/" . $nombreImagen;
        $imagenServidor->save($imagenPath);

        //guardar cambios
        $dish = new  Dish();
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->image = $nombreImagen;
        $dish->cost = 0;
        $dish->price = $request->price;
        $dish->cal = $request->cal;
        $dish->category_id = $request->category_id;
        $dish->save();

        //guardar los ingredientes
        foreach ($request->dishIngredients as $key => $value) {
            if ($value != null) {
                $dishIngredient = new  DishIngredient();
                $dishIngredient->amount = $value;
                $dishIngredient->dish_id = $dish->id;
                $dishIngredient->ingredient_id = $key;
                $dishIngredient->save();
            }
        }

        $request->session()->flash('message', "Platillo registrado con éxito");
        $request->session()->flash('type', "success");


        return redirect()->route('dish.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Dish $dish)
    {
        return view('dish.show', compact('dish'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Dish $dish)
    {
        $dishIngredients = array();
        $categories = Category::all();
        $ingredients = Ingredient::where('id', '!=', 0)->orderBy('name')->get();

        foreach ($ingredients as $ingredient) {
            $dishIngredients[$ingredient->id] = 0;
        }
        foreach ($dish->dishIngredients as $dishIngredient) {
            $dishIngredients[$dishIngredient->ingredient_id] = $dishIngredient->amount;
        }
        /* dd($dishIngredients); */
        /*  dd($dish->dishIngredients, $dishIngredients); */
        return view('dish.edit', compact('dish', 'categories', 'ingredients', 'dishIngredients'));
    }

    /**
     * @param \App\Http\Requests\DishUpdateRequest $request
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        /*  $dish->update($request->validated());

        $request->session()->flash('dish.id', $dish->id); */
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'cal' => 'required',
            'category_id' => 'required|numeric',
            'dishIngredients' => 'required|array',
            'dishIngredients.*' => 'numeric|nullable',
        ]);


        //guardar imagen
        if ($request->image) {
            $imagen = $request->file('image');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(500, 500);
            $imagenPath = public_path('img/dishes') . "/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } else {
            $nombreImagen = $dish->image;
        }


        //guardar cambios
        $dish->name = $request->name;
        $dish->description = $request->description;
        $dish->image = $nombreImagen;
        $dish->cost = 0;
        $dish->price = $request->price;
        $dish->cal = $request->cal;
        $dish->category_id = $request->category_id;
        $dish->save();

        //eliminar los registros existentes
        foreach (DishIngredient::where('dish_id', $dish->id)->get() as $aux) {
            $aux->delete();
        }
        $cost = 0;
        //guardar los ingredientes
        foreach ($request->dishIngredients as $key => $value) {
            if ($value != null && $value != 0) {
                $dishIngredient = new  DishIngredient();
                $dishIngredient->amount = $value;
                $dishIngredient->dish_id = $dish->id;
                $dishIngredient->ingredient_id = $key;
                $dishIngredient->save();
                $cost+= $dishIngredient->amount* $dishIngredient->ingredient->cost;
            }
        }
        $dish->cost = $cost;
        $dish->save();
        $request->session()->flash('message', "Platillo Actualizado con éxito");
        $request->session()->flash('type', "success");


        return redirect()->route('dish.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Dish $dish)
    {
        $dish->delete();

        return redirect()->route('dish.index');
    }
}
