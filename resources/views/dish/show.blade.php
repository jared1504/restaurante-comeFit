@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver Platillo</h2>
    <p>Ve los datos de un platillo</p>
    <div class="flex">
        <div class="view__image">
                    <img  src="../img/dishes/{{$dish->image}}" alt="Imagen platillo {{$dish->name}}">

        </div>
        <div class="view">
            <p class="view__item"><span>Código: </span>{{$dish->id}}</p>
            <p class="view__item"><span>Nombre: </span>{{$dish->name}}</p>
            <p class="view__item"><span>Descripción: </span></p>
            <p class="view__item">{{$dish->description}}</p>
            <p class="view__item"><span>Ingredientes: </span></p>
            @foreach ($dish->dishIngredients as $dishIngredient)
            <li class="view__item">{{$dishIngredient->amount}} {{$dishIngredient->ingredient->name}}</li>
            @endforeach
            <p class="view__item"><span>Calorías: </span>{{$dish->cal}}</p>
            <p class="view__item"><span>Costo: </span>${{$dish->cost}}</p>
            <p class="view__item"><span>Precio: </span>${{$dish->price}}</p>
            <p class="view__item"><span>Categoría: </span>{{$dish->category->name}}</p>
            <a class="view__edit" href="{{route('dish.edit', $dish)}}">Actualizar</a>
        </div>
    </div>
</x-dashboard>