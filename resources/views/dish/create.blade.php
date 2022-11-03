@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];

$dishIngredients=array();
array_push($dishIngredients, ['key', 'otherKey'])
@endphp
{{-- {{$ingredients}} --}}
<x-dashboard :items="$items">
    <h2>Registrar Platillo</h2>
    <p>Registra un nuevo platillo</p>
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
            <input value="{{old('description')}}" class="form__input" type="text" name="description" id="description"
                placeholder="Descripción del platillo">
            @error('description') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="image">Imagen</label>
            <input value="{{old('image')}}" class="form__input" type="file" name="image" id="image">
            @error('image') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="cal">Calorías</label>
            <input value="{{old('cal')}}" class="form__input" type="number" name="cal" id="cal"
                placeholder="Calorías del platillo">
            @error('cal') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="categoy_id">Categoría</label>
            <select  name="category_id" id="category_id" class="form__input">
                <option>Seleccione una categoría</option>
                @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach    
            </select>
            @error('category_id') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="categoy_id">Ingrediente</label>
            
            <select  name="category_id" id="unit" class="form__input">
                
                <option>Seleccione un ingrediente</option>
                @foreach ($ingredients as $ingredient)
                <input type="number" name="ingredientAmount[]">
                <input type="checkbox" id="" value="{{$ingredient->id}}" name="ingredient[]"> <label for="cbox2">{{$ingredient->name}}</label>
                {{-- <option value="{{$category->id}}">{{$category->name}}</option> --}}
                @endforeach    
            </select>
            @error('category_id') <div class="form__error">{{$message}}</div> @enderror
        </div>
       
        <div class="form__item">
            <label class="form__label" for="cost">Costo</label>
            <input value="{{old('cost')}}" class="form__input" type="number" name="cost" id="cost"
                placeholder="Costo del platillo">
            @error('cost') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="price">Precio</label>
            <input value="{{old('price')}}" class="form__input" type="number" name="price" id="price"
                placeholder="Precio del platillo">
            @error('price') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Platillo">
        </div>

    </form>
</x-dashboard>