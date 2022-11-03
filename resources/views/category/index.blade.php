@php
$items = [
['route'=> 'category.index', 'text' => 'Categorías'],
['route'=> 'category.create', 'text' => 'Nueva Categoría'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Categorías</h2>
    <p>Administra las Categorías de los platillos</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Nombre</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($categories as $category)
        <tr class="dashboard__table__body">
            <td>{{$category->id}}</td>
            <td>{{$category->name}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('category.show', $category)}}">Ver</a>
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('category.edit', $category)}}">Editar</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>