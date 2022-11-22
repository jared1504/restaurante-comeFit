@php
$items = [
['route'=> 'waiter.create', 'text' => 'Nueva Venta'],
['route'=> 'waiter.index', 'text' => 'Ver Ventas'],
];

@endphp
<x-dashboard :items="$items">
    <h2>Nueva venta</h2>
    <p>Crea una nueva venta</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <form action="{{route('waiter.store')}}" method="POST" class="salewaiter">
        @csrf
        <h2 class="salewaiter__title">Elige una mesa</h2>

        <div class="salewaiter__tables">
            @foreach ($tables as $table)
            <div class="salewaiter__table salewaiter__table__{{$table->status}}">
                <input type="radio" id="table-{{$table->id}}" name="table" value="{{$table->id}}"
                    @if($table->status==0)disabled @endif>
                <label for="table-{{$table->id}}">{{$table->id}}</label>
            </div>
            @endforeach
        </div>
        <div class="salewaiter__chooseDishes">
            <h2 class="salewaiter__title">Seleccione los Platillos</h2>
            <div class="">
                @foreach ($categories as $category)
                @if (count($category->dishes)>0)
                    <h2 class="salewaiter__title">{{$category->name}}</h2>
                    <div class="salewaiter__dishes">
                        @foreach ($category->dishes as $dish)
                        <div class="salewaiter__dish">
                            <input min="0" id="{{$dish->id}}" class="salewaiter__dish__input" value="0" type="number"
                            name="dishes[{{$dish->id}}]">
                            <label for="{{$dish->id}}" class="salewaiter__dish__label ">{{$dish->name}}</label>
                        </div>
                        @endforeach
                    </div>
                @endif
                @endforeach
            </div>
            <div class="form__submit mt-5">
            <input class="form__submit__input" type="submit" value="Registrar Venta">
        </div>
        </div>
        
    </form>

</x-dashboard>