@php
$items = [
['route'=> 'dish.index', 'text' => 'Platillos'],
['route'=> 'dish.create', 'text' => 'Nuevo Platillo'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Platillos</h2>
    <p>Administra los platillos</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Nombre</td>
            <td>Costo</td>
            <td>Precio</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($dishes as $dish)
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
        <tfoot>
            <tr>
                <th colspan="5">{{ $dishes->links() }}</th>
            </tr>
        </tfoot>
    </table>
</x-dashboard>