@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];

/* foreach ($dishIngredients as $key =>$value) {
   echo($key," ",$value);
} */

@endphp
{{-- {{$dishIngredients}} --}}
<x-dashboard :items="$items">
    <h2>Actualizar Platillo</h2>
    <p>Actualiza un platillo</p>
    <form action="{{route('dish.update',$dish)}}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <p class="form__title">Llena los campos para actualizar un Platillo</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{$dish->name}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del ingrediente">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="description">Descripción</label>
            <textarea name="description" id="description"
                class="form__input form__textarea">{{$dish->description}}</textarea>
            @error('description') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="image">Imagen</label>
            <input class="form__input" type="file" name="image" id="image">
            @error('image') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="cal">Calorías</label>
            <input value="{{$dish->cal}}" class="form__input" type="number" name="cal" id="cal"
                placeholder="Calorías del platillo">
            @error('cal') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="categoy_id">Categoría</label>
            <select name="category_id" id="category_id" class="form__input">
                <option>Seleccione una categoría</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($dish->category_id == $category->id) {{'selected'}}
                    @endif>{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="categoy_id">Seleccione los ingredientes</label>

            <div class="form__container">
                @foreach ($ingredients as $ingredient)
                <div class="form__ingredients">
                    <input class="form__ingredients__input"
                        value="{{$dishIngredients[$ingredient->id]}}" type="text"
                        name="dishIngredients[{{$ingredient->id}}]">
                    <label class="form__ingredients__label">{{$ingredient->unit}}s de {{$ingredient->name}}</label>
                </div>
                @endforeach
            </div>
            @error('dishIngredient2s') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="cost">Costo</label>
            <input disabled value="{{$dish->cost}}" class="form__input" type="number" name="cost" id="cost"
                placeholder="Costo del platillo">
            @error('cost') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="price">Precio</label>
            <input value="{{$dish->price}}" class="form__input" type="number" name="price" id="price"
                placeholder="Precio del platillo">
            @error('price') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Actualizar Platillo">
        </div>

    </form>

</x-dashboard>