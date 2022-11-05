@php
$items = [
['route'=> 'order.index', 'text' => 'Pedidos'],
['route'=> 'order.create', 'text' => 'Nuevo Pedido'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Realizar Pedido</h2>
    <p>Realiza un nuevo pedido</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <form action="{{route('order.store')}}" method="POST" class="form" enctype="multipart/form-data">
        @csrf
        <p class="form__title">Llena los campos para realizar un pedido</p>
        <div class="form__item">
            <label class="form__label" for="supplier_id">Proveedor</label>
            <select name="supplier_id" id="supplier_id" class="form__input">
                <option>Seleccione un Proveedor</option>
                @foreach ($suppliers as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                @endforeach
            </select>
            @error('supplier_id') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__item">
            <label class="form__label" for="categoy_id">Seleccione los ingredientes</label>
            <div class="form__container">
                @foreach ($ingredients as $ingredient)
                <div class="form__ingredients">
                    <input class="form__ingredients__input"
                        value="{{ old('orderIngredients[$ingredient->id]') }}" type="text"
                        name="orderIngredients[{{$ingredient->id}}]">
                    <label class="form__ingredients__label">{{$ingredient->unit}}s de {{$ingredient->name}}</label>
                </div>
                @endforeach
            </div>
            @error('orderIngredients') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Pedido">
        </div>

    </form>
</x-dashboard>