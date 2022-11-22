@php
$items = [
['route'=> 'chef.index', 'text' => 'Pendientes'],
['route'=> 'chef.filter', 'text' => 'Preparadas'],
];
@endphp
<x-dashboard :items="$items">
    <h2>Ver venta</h2>
    <p>Ve el detalle de una venta</p>

    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif

    <p class="salewaiter__description"><span>Folio: </span>{{$sale->id}}</p>
    @php
    switch($sale->status){
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
    <p class="salewaiter__description"><span>Estado: </span>{{$sale->status}}</p>
    <h2 class="salewaiter__detail">Detalle de platillos</h2>
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Cantidad</td>
            <td>Nombre</td>
            @if ($sale->status=="En Preparación")
            <td>Estado</td>
            @endif

            <td>Acciones</td>
        </tr>
        @foreach ($sale->saleDetails as $saleDetail)
        <tr class="dashboard__table__body">
            <td>{{$saleDetail->amount}}</td>
            <td>{{$saleDetail->dish->name}}</td>

            @if ($sale->status=="En Preparación")
            @php
            switch($saleDetail->status){
            case 1:
            $saleDetail->status="Preparando";
            break;
            case 2:
            $saleDetail->status="Listo";
            break;
            }
            @endphp
            <td class="dashboard__table__enlace">
                <form action="{{route('chef.update', $saleDetail)}}" method="POST" class="dashboard__table__enlace">
                    @csrf
                    @method('PUT')
                    <input class="dashboard__table__enlace__a dashboard__table__enlace__{{$saleDetail->status}}"
                        type="submit" value="{{$saleDetail->status}}">
                </form>
            </td>
            @endif

            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('dish.show', $saleDetail->dish)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>