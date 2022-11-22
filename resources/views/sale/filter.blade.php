@php
$items = [
['route'=> 'sale.index', 'text' => 'Ventas del día'],
['route'=> 'sale.filter', 'text' => 'Historial de ventas'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Historial de Ventas</h2>
    <p>Ve las ventas de un día en especifico</p>
    <form action="{{route('sale.filter')}}" method="POST" class="filterSales">
        @csrf
        <label for="date" class="filterSales__label">Fecha:</label>
        <input type="date" name="date" value="{{date($fecha)}}" class="filterSales__input">
        <input type="submit" value="Filtrar Ventas" class="filterSales__submit">
    </form>
    <h5 class="salewaiter__total"><span>Total: $</span>{{$total}}</h5>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Folio</td>
            <td>Estado</td>
            <td>Total</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($sales as $sale)
        <tr class="dashboard__table__body">
            <td>{{$sale->id}}</td>
            @php
            switch ($sale->status) {
            case 1:
            $sale->status = "En Preparación";
            break;
            case 2:
            $sale->status = "Platillos Listos";
            break;
            case 3:
            $sale->status = "Entregada a los comensales";
            break;
            case 4:
            $sale->status = "Pago solicitado";
            break;
            case 5:
            $sale->status = "Pagada";
            break;
            case 6:
            $sale->status = "Concluida";
            break;
            }
            @endphp
            <td>{{$sale->status}}</td>
            <td>${{$sale->total}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show" href="{{route('sale.show', $sale)}}">Ver</a>
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