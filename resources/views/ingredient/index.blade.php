@php
$items = [
['route'=> 'ingredient.index', 'text' => 'Ingredientes'],
['route'=> 'ingredient.create', 'text' => 'Nuevo Ingrediente'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ingredientes</h2>
    <p>Administra los ingredientes</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Nombre</td>
            <td>Unidad</td>
            <td>Stock</td>
            <td>Costo</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($ingredients as $ingredient)
        <tr class="dashboard__table__body">
            <td>{{$ingredient->id}}</td>
            <td>{{$ingredient->name}}</td>
            <td>{{$ingredient->unit}}</td>
            <td>{{$ingredient->stock}}</td>
            <td>$ {{$ingredient->cost}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('ingredient.show', $ingredient)}}">Ver</a>
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('ingredient.edit', $ingredient)}}">Editar</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>