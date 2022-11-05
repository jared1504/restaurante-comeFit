@php
$items = [
['route'=> 'user.index', 'text' => 'Empleados'],
['route'=> 'user.create', 'text' => 'Nuevo Empleado'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Ver Empleado</h2>
    <p>Ve los datos de un empleado</p>
    <div class="view">
        <p class="view__item"><span>Código: </span>{{$user->id}}</p>
        <p class="view__item"><span>Nombre: </span>{{$user->name}}</p>
        <p class="view__item"><span>Email: </span>{{$user->email}}</p>
        @php
        switch($user->type){
            case 1:
            $user->type="Administrador";
            break;
            case 2:
            $user->type="Mesero";
            break;
            case 3:
            $user->type="Cajero";
            break;
            case 4:
            $user->type="Chef";
            break;
        }
        @endphp
        <p class="view__item"><span>Rol: </span>{{$user->type}}</p>
        <a class="view__edit" href="{{route('user.edit', $user)}}">Actualizar</a>
    </div>
</x-dashboard>