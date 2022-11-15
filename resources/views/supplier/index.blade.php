@php
$items = [
['route'=> 'supplier.index', 'text' => 'Proveedores'],
['route'=> 'supplier.create', 'text' => 'Nuevo Proveedor'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Proveedores</h2>
    <p>Administra los proveedores</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif
    <table class="dashboard__table">
        <tr class="dashboard__table__title">
            <td>Código</td>
            <td>Nombre</td>
            <td class="dashboard__table__title__actions">Acciones</td>

        </tr>
        @foreach ($suppliers as $supplier)
        <tr class="dashboard__table__body">
            <td>{{$supplier->id}}</td>
            <td>{{$supplier->name}}</td>
            <td class="dashboard__table__actions">
                <a class="dashboard__table__action dashboard__table__show"
                    href="{{route('supplier.show', $supplier)}}">Ver</a>
                <a class="dashboard__table__action dashboard__table__edit"
                    href="{{route('supplier.edit', $supplier)}}">Editar</a>
            </td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <th colspan="5">{{ $suppliers->links() }}</th>
            </tr>
        </tfoot>
    </table>
</x-dashboard>