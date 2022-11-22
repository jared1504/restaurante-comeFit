@php
$rol = auth()->user()->getRoleNames(); //obtener el rol del usuario
if ($rol[0] == "admin") { //el usuario es administrador
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];
} else{
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
];
}
@endphp

<x-dashboard :items="$items">
    <h2>Ver Platillo</h2>
    <p>Ve los datos de un platillo</p>
    <div class="flex">
        <div class="view__image">
            <img src="../img/dishes/{{$dish->image}}" alt="Imagen platillo {{$dish->name}}">

        </div>
        <div class="view">
            <p class="view__item"><span>Código: </span>{{$dish->id}}</p>
            <p class="view__item"><span>Nombre: </span>{{$dish->name}}</p>
            @role('waiter')
            <p class="view__item"><span>Precio: </span>${{$dish->price}}</p>
            @endrole
            <p class="view__item"><span>Descripción: </span></p>
            <p class="view__item">{{$dish->description}}</p>
            <p class="view__item"><span>Ingredientes: </span></p>
            @foreach ($dish->dishIngredients as $dishIngredient)
            <p class="view__item">{{$dishIngredient->amount}} {{$dishIngredient->ingredient->name}}</p>
            @endforeach
            <p class="view__item"><span>Calorías: </span>{{$dish->cal}}</p>
            <p class="view__item"><span>Categoría: </span>{{$dish->category->name}}</p>
            @role('admin')
            <p class="view__item"><span>Costo: </span>${{$dish->cost}}</p>
            <p class="view__item"><span>Precio: </span>${{$dish->price}}</p>
            <a class="view__edit" href="{{route('dish.edit', $dish)}}">Actualizar</a>
            @endrole
        </div>
    </div>
</x-dashboard>