@php
$items = [
['route'=> 'category.index', 'text' => 'Categorías'],
['route'=> 'category.create', 'text' => 'Nueva Categoría'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Registrar Categoría</h2>
    <p>Registra una nueva categoría</p>
    <form action="{{route('category.store')}}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <p class="form__title">Llena los campos para agregar una categoría</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{old('name')}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre de la categoría">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="image">Imagen</label>
            <input class="form__input" type="file" name="image" id="image">
            @error('image') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Categoría">
        </div>

    </form>
</x-dashboard>