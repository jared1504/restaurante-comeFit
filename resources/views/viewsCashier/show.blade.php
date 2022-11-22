@php
$items = [
['route'=> 'cashier.index', 'text' => 'Pendientes'],
['route'=> 'cashier.filter', 'text' => 'Cobradas'],
];

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
<x-dashboard :items="$items">
    <h2>Cobrar Venta</h2>
    <p>Ve el detalle de una venta y cobrala</p>

    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif

    <p class="salewaiter__description"><span>Folio: </span>{{$sale->id}}</p>
    <p class="salewaiter__description"><span>Estado: </span>{{$sale->status}}</p>
    <p class="salewaiter__description"><span>Total: </span>${{$sale->total}}</p>

    @if ($sale->status=="Pago solicitado")
    <form action="{{route('cashier.update', $sale)}}" method="POST" class="salewaiter__form">
        @csrf
        @method('PUT')
        <input type="submit" value="Cobrar">
    </form>
    @endif

    <h2 class="salewaiter__detail">Detalle de platillos</h2>
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Cantidad</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Subtotal</td>
            <td>Acciones</td>
        </tr>
        @foreach ($sale->saleDetails as $saleDetail)
        <tr class="dashboard__table__body">
            <td>{{$saleDetail->amount}}</td>
            <td>{{$saleDetail->dish->name}}</td>
            <td>${{$saleDetail->price}}</td>
            <td>${{$saleDetail->subtotal}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('dish.show', $saleDetail->dish)}}">Ver</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>