@php
$items = [
['route'=> 'supplier.index', 'text' => 'Proveedores'],
['route'=> 'supplier.create', 'text' => 'Nuevo Proveedor'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Actualizar Proveedor</h2>
    <p>Actualiza un nuevo proveedor</p>
    <form action="{{route('supplier.update',$supplier)}}" method="POST" class="form">
        @csrf
        @method('PUT')
        <p class="form__title">Llena los campos para actualizar un proveedor</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{$supplier->name}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del proveedor">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="email">Email</label>
            <input value="{{$supplier->email}}" class="form__input" type="text" name="email" id="email"
                placeholder="Email del proveedor">
            @error('email') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="phone">Teléfono</label>
            <input value="{{$supplier->phone}}" class="form__input" type="string" name="phone" id="phone"
                placeholder="Teléfono del proveedor">
            @error('phone') <div class="form__error">{{$message}}</div> @enderror
        </div>
       
        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Actulizar Proveedor">
        </div>
</x-dashboard>