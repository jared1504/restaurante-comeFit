@php
$items = [
['route'=> 'user.index', 'text' => 'Empleados'],
['route'=> 'user.create', 'text' => 'Nuevo Empleado'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Empleados</h2>
    <p>Administra los empleados</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    {{-- 1-> admin, 2-> mesero, 3->cajero, 4->chef --}}
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Nombre</td>
            <td>Rol</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($users as $user)
        <tr class="dashboard__table__body">
            <td>{{$user->name}}</td>
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
            <td>{{$user->type}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show" href="{{route('user.show', $user)}}">Ver</a>
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('user.edit', $user)}}">Editar</a>
            </td>
        </tr>
        @endforeach
    </table>
</x-dashboard>