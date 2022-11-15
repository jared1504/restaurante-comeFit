@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];

@endphp
{{-- {{$ingredients}} --}}
<x-dashboard :items="$items">
    <h2>Registrar Platillo</h2>
    <p>Registra un nuevo platillo</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <form action="{{route('dish.store')}}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <p class="form__title">Llena los campos para agregar un Platillo</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{old('name')}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del ingrediente">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="description">Descripción</label>
            <textarea name="description" id="description" class="form__input form__textarea">{{old('description')}}</textarea>
            @error('description') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="image">Imagen</label>
            <input class="form__input" type="file" name="image" id="image">
            @error('image') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="price">Precio</label>
            <input value="{{old('price')}}" class="form__input" type="number" name="price" id="price"
                placeholder="Precio del platillo">
            @error('price') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="cal">Calorías</label>
            <input value="{{old('cal')}}" class="form__input" type="number" name="cal" id="cal"
                placeholder="Calorías del platillo">
            @error('cal') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="categoy_id">Categoría</label>
            <select name="category_id" id="category_id" class="form__input">
                <option>Seleccione una categoría</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
            @error('category_id') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="categoy_id">Seleccione los ingredientes</label>

            <div class="form__container">
                @foreach ($ingredients as $ingredient)
                <div class="form__ingredients">
                    <input class="form__ingredients__input" value="{{ old('dishIngredients[@php $ingredient->id @endphp]') }}"
                        type="text" name="dishIngredients[{{$ingredient->id}}]">
                    <label class="form__ingredients__label ">{{$ingredient->unit}}s de {{$ingredient->name}}</label>
                </div>
                @endforeach
            </div>
            @error('dishIngredient2s') <div class="form__error">{{$message}}</div> @enderror
        </div>


        
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Platillo">
        </div>

    </form>
</x-dashboard>