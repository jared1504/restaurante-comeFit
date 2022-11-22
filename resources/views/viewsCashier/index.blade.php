@php
$items = [
['route'=> 'cashier.index', 'text' => 'Pendientes'],
['route'=> 'cashier.filter', 'text' => 'Cobradas'],
];

@endphp
<x-dashboard :items="$items">
    <h2>Ver ventas por cobrar</h2>
    <p>Ve las ventas pendientes por cobrar</p>

    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Folio</td>
            <td>Estado</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($sales as $sale)
        <tr class="dashboard__table__body">
            <td>{{$sale->id}}</td>
            @php
            switch($sale->status){
            case 4:
            $sale->status="Pago solicitado";
            break;
            
            }
            @endphp
            <td>{{$sale->status}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show" href="{{route('cashier.show', $sale)}}">Ver</a>
            </td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <th colspan="5">{{ $sales->links() }}</th>
            </tr>
        </tfoot>
    </table>
</x-dashboard>