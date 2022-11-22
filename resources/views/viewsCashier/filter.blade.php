@php
$items = [
['route'=> 'cashier.index', 'text' => 'Pendientes'],
['route'=> 'cashier.filter', 'text' => 'Cobradas'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ventas cobradas</h2>
    <p>Ve las ventas que cobraste hoy</p>
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
                <a class="dashboard__table__action dashboard__table__show" href="{{route('cashier.show', $sale)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>