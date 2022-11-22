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
            @role('admin')
            <td>Costo</td>
            <td>Precio</td>
            @endrole
            @role('waiter')
            <td>Precio</td>
            @endrole
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($dishes as $dish)
        <tr class="dashboard__table__body">
            <td>{{$dish->id}}</td>
            <td>{{$dish->name}}</td>
            @role('admin')
            <td>$ {{$dish->cost}}</td>
            <td>$ {{$dish->price}}</td>
            @endrole
            @role('waiter')
            <td>$ {{$dish->price}}</td>
            @endrole

            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show" href="{{route('dish.show', $dish)}}">Ver</a>
                @role('admin')
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('dish.edit', $dish)}}">Editar</a>
                @endrole
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