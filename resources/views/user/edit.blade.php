@php
$items = [
['route'=> 'user.index', 'text' => 'Empleados'],
['route'=> 'user.create', 'text' => 'Nuevo Empleado'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Actualizar Empleado</h2>
    <p>Actualiza un nuevo empleado</p>
    <form action="{{route('user.update',$user)}}" method="POST" class="form">
        @csrf
        @method('PUT')
        <p class="form__title">Llena los campos para actualizar un empleado</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{$user->name}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del empleado">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="email">Email</label>
            <input value="{{$user->email}}" class="form__input" type="text" name="email" id="email"
                placeholder="Email del proveedor">
            @error('email') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="type">Rol</label>
            <select name="type" id="type" class="form__input">
                <option>Seleccione una categoría</option>
                <option value="1" @if($user->type == 1) {{'selected'}} @endif>Administrador</option>
                <option value="2" @if($user->type == 2) {{'selected'}} @endif>Mesero</option>
                <option value="3" @if($user->type == 3) {{'selected'}} @endif>Cajero</option>
                <option value="4" @if($user->type == 4) {{'selected'}} @endif>Chef</option>
            </select>
            @error('type') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Actualizar Empleado">
        </div>
</x-dashboard>