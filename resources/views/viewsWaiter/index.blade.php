@php
$items = [
['route'=> 'waiter.create', 'text' => 'Nueva Venta'],
['route'=> 'waiter.index', 'text' => 'Ver Ventas'],
];

@endphp
<x-dashboard :items="$items">
    <h2>Ver ventas</h2>
    <p>Ve tus ventas del día</p>

    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Folio</td>
            <td>Estado</td>
            <td>Mesa</td>
            <td class="dashboard__table__title__actions">Acciones</td>
        </tr>
        @foreach ($sales as $sale)
        <tr class="dashboard__table__body">
            <td>{{$sale->id}}</td>
            <td>{{$sale->status}}</td>
            <td>{{$sale->table_id}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('waiter.show', $sale)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>