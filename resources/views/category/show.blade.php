@php
$items = [
['route'=> 'category.index', 'text' => 'Categorías'],
['route'=> 'category.create', 'text' => 'Nueva Categoría'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver Categoría</h2>
    <p>Ve los datos de ua Categoría</p>
    <div class="flex">
        <img class="view__image" src="../img/categories/{{$category->image}}" alt="Imagen platillo {{$category->name}}">
        <div class="view">
            <p class="view__item"><span>Código: </span>{{$category->id}}</p>
            <p class="view__item"><span>Nombre: </span>{{$category->name}}</p>
            <a class="view__edit" href="{{route('category.edit', $category)}}">Actualizar</a>
        </div>
    </div>
    @if (count($category->dishes)>0)
    <h2 class="view__subtitle">Platillos de la categoría: {{$category->name}}</h2>

    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Nombre</td>
            <td>Costo</td>
            <td>Precio</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($category->dishes as $dish)
        <tr class="dashboard__table__body">
            <td>{{$dish->id}}</td>
            <td>{{$dish->name}}</td>
            <td>$ {{$dish->cost}}</td>
            <td>$ {{$dish->price}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show" href="{{route('dish.show', $dish)}}">Ver</a>
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('dish.edit', $dish)}}">Editar</a>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    <h2 class="view__subtitle">Aún no hay platillos en esta Categoría</h2>
    @endif

</x-dashboard>