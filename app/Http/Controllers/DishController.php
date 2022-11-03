<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests\DishStoreRequest;
use App\Http\Requests\DishUpdateRequest;
use App\Models\Category;
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
        $categories=Category::all();
        $ingredients=Ingredient::all();
        return view('dish.create', compact('categories','ingredients'));
    }

    /**
     * @param \App\Http\Requests\DishStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
       /*  $dish = Dish::create($request->validated());

        $request->session()->flash('dish.id', $dish->id); */
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'cal' => 'required',
            'category_id' => 'required|numeric',
        ]);
        $ingredients=[];
        foreach($ingredients as $ingredient){
            $ingredient->amount;
        }

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
        $dish->cost = $request->cost;
        $dish->price = $request->price;
        $dish->cal = $request->cal;
        $dish->category_id = $request->category_id;
        $dish->save();

        
        $request->session()->flash('message', "Platillo registrado con éxito");


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
        return view('dish.edit', compact('dish'));
    }

    /**
     * @param \App\Http\Requests\DishUpdateRequest $request
     * @param \App\Models\Dish $dish
     * @return \Illuminate\Http\Response
     */
    public function update(DishUpdateRequest $request, Dish $dish)
    {
        $dish->update($request->validated());

        $request->session()->flash('dish.id', $dish->id);

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
