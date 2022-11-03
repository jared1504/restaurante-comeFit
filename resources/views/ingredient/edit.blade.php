@php
$items = [
['route'=> 'ingredient.index', 'text' => 'Ingredientes'],
['route'=> 'ingredient.create', 'text' => 'Nuevo Ingrediente'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Actualizar ingrediente</h2>
    <p>Actualiza los datos de un ingrediente</p>
    <form action="{{route('ingredient.update', $ingredient)}}" method="POST" class="form">
        @csrf
        @method('PUT')
        <p class="form__title">Llena los campos para actualizar un ingrediente</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{$ingredient->name}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del ingrediente">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="unit">Unidad de medida</label>
            <select value="{{$ingredient->unit}}" name="unit" id="unit" class="form__input">
                <option value="">Seleccione la unidad de medida</option>
                <option value="Kilogramo">Kilogramo</option>
                <option value="Litro">Litro</option>
            </select>
            @error('unit') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="stock">Stock</label>
            <input value="{{$ingredient->stock}}" class="form__input" type="number" name="stock" id="stock"
                placeholder="Stock del ingrediente">
            @error('stock') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="cost">Costo</label>
            <input value="{{$ingredient->cost}}" class="form__input" type="number" name="cost" id="cost"
                placeholder="Costo del ingrediente">
            @error('cost') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Actualizar Ingrediente">
        </div>

    </form>
</x-dashboard>