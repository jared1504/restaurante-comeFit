@php
$items = [
['route'=> 'ingredient.index', 'text' => 'Ingredientes'],
['route'=> 'ingredient.create', 'text' => 'Nuevo Ingrediente'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Registrar ingrediente</h2>
    <p>Registra un nuevo ingrediente</p>
    <form action="{{route('ingredient.store')}}" method="POST" class="form">
        @csrf
        <p class="form__title">Llena los campos para agregar un Ingrediente</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{old('name')}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del ingrediente">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="unit">Unidad de medida</label>
            <select value="{{old('unit')}}" name="unit" id="unit" class="form__input">
                <option value="">Seleccione la unidad de medida</option>
                <option value="Kilogramo">Kilogramo</option>
                <option value="Litro">Litro</option>
            </select>
            @error('unit') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="stock">Stock</label>
            <input value="{{old('stock')}}" class="form__input" type="number" name="stock" id="stock"
                placeholder="Stock del ingrediente">
            @error('stock') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="cost">Costo</label>
            <input value="{{old('cost')}}" class="form__input" type="number" name="cost" id="cost"
                placeholder="Costo del ingrediente">
            @error('cost') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Ingrediente">
        </div>

    </form>
</x-dashboard>