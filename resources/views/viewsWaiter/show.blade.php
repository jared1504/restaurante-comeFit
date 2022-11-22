@php
$items = [
['route'=> 'waiter.create', 'text' => 'Nueva Venta'],
['route'=> 'waiter.index', 'text' => 'Ver Ventas'],
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
    <p class="salewaiter__description"><span>Total: </span>${{$sale->total}}</p>
    <p class="salewaiter__description"><span>Mesa: </span>{{$sale->table_id}}</p>
    <p class="salewaiter__description"><span>Estado: </span>{{$sale->status}}</p>
    @if ($sale->status=="Platillos Listos"||$sale->status=="Entregada a los comensales"||$sale->status=="Pagada")
    <form action="{{route('waiter.update', $sale)}}" method="POST" class="salewaiter__form">
        @csrf
        @method('PUT')
        @if ($sale->status=="Platillos Listos")
        <input type="submit" value="Entregar Platillos">
        @endif
        @if ($sale->status=="Entregada a los comensales") 
        <input type="submit" value="Solicitar Pago">
        @endif
        @if ($sale->status=="Pagada") 
        <input type="submit" value="Concluir venta">
        @endif
        
    </form>
    @endif
    <h2 class="salewaiter__detail">Detalle de platillos</h2>
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Cantidad</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Total</td>
            <td>Estado</td>
        </tr>
        @foreach ($sale->saleDetails as $saleDetail)
        <tr class="dashboard__table__body">
            <td>{{$saleDetail->amount}}</td>
            <td>{{$saleDetail->dish->name}}</td>
            <td>${{$saleDetail->price}}</td>
            <td>${{$saleDetail->subtotal}}</td>
            @php
            switch($saleDetail->status){
            case 1:
            $saleDetail->status="Preparando";
            break;
            case 2:
            $saleDetail->status="Listo";
            break;
            case 3:
            $saleDetail->status="Entregado";
            break;
            }
            @endphp
            <td>{{$saleDetail->status}}</td>
        </tr>
        @endforeach
    </table>
</x-dashboard>