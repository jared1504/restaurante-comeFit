@php
$items = [
['route'=> 'user.index', 'text' => 'Empleados'],
['route'=> 'user.create', 'text' => 'Nuevo Empleado'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Registrar Empleado</h2>
    <p>Registra un nuevo empleado</p>
    <form action="{{route('user.store')}}" method="POST" class="form">
        @csrf
        <p class="form__title">Llena los campos para agregar un empleado</p>
        <div class="form__item">
            <label class="form__label" for="name">Nombre</label>
            <input value="{{old('name')}}" class="form__input" type="text" name="name" id="name"
                placeholder="Nombre del empleado">
            @error('name') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="email">Email</label>
            <input value="{{old('email')}}" class="form__input" type="text" name="email" id="email"
                placeholder="Email del proveedor">
            @error('email') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="password">Password</label>
            <input class="form__input" type="password" name="password" id="password">
            @error('password') <div class="form__error">{{$message}}</div> @enderror
        </div>
        <div class="form__item">
            <label class="form__label" for="type">Rol</label>
            <select name="type" id="type" class="form__input">
                <option>Seleccione una categoría</option>
                <option value="1">Administrador</option>
                <option value="2">Mesero</option>
                <option value="3">Cajero</option>
                <option value="4">Chef</option>
            </select>
            @error('type') <div class="form__error">{{$message}}</div> @enderror
        </div>

        <div class="form__submit">
            <input class="form__submit__input" type="submit" value="Registrar Empleado">
        </div>
</x-dashboard>