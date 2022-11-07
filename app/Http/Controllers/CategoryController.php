<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('category.create');
    }

    /**
     * @param \App\Http\Requests\CategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* $category = Category::create($request->validated());

        $request->session()->flash('category.id', $category->id); */
        $this->validate($request, [
            'name' => 'required',
            'image' => 'required',
        ]);


        //guardar imagen
        $imagen = $request->file('image');
        $nombreImagen = Str::uuid() . "." . $imagen->extension();
        $imagenServidor = Image::make($imagen);
        $imagenServidor->fit(400, 400);
        $imagenPath = public_path('img/categories') . "/" . $nombreImagen;
        $imagenServidor->save($imagenPath);

        //guardar cambios
        $category = new  Category();
        $category->name = $request->name;
        $category->image = $nombreImagen;
        $category->save();



        $request->session()->flash('message', "Categoría registrada con éxito");
        $request->session()->flash('type', "success");


        return redirect()->route('category.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        return view('category.show', compact('category'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * @param \App\Http\Requests\CategoryUpdateRequest $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        /* $category->update($request->validated());

        $request->session()->flash('category.id', $category->id); */
        $this->validate($request, [
            'name' => 'required',
        ]);

        //guardar imagen
        if ($request->image) {
            $imagen = $request->file('image');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(400, 400);
            $imagenPath = public_path('img/categories') . "/" . $nombreImagen;
            $imagenServidor->save($imagenPath);
        } else {
            $nombreImagen = $category->image;
        }

        //guardar cambios
        $category->name = $request->name;
        $category->image = $nombreImagen;
        $category->save();


        $request->session()->flash('message', "Categoría Actualizada con éxito");
        $request->session()->flash('type', "success");



        return redirect()->route('category.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        return redirect()->route('category.index');
    }
}
