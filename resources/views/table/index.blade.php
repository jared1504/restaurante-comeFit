@php
$items = [
['route'=> 'table.index', 'text' => 'Mesas'],
];
@endphp

<x-dashboard :items="$items">
    <h2>Mesas</h2>
    <p>Administra las mesas</p>
    @if(session("message"))
    <div class="dashboard__notification  dashboard__notification__{{session('type')}}">
        {{session('message')}}
    </div>
    @endif

    <form action="{{route('table.store')}}" method="POST" class="view__form-table">
        @csrf
        <input type="submit" value="Agregar Mesa" class="view__form-table__submit">
    </form>

    <div class="view__tables">
        @foreach ($tables as $table)
        <form action="{{route('table.update', $table)}}" method="POST">
            @csrf
            @method('PUT')
            <input type="submit" value="{{$table->id}}"
                class="view__tables__table view__tables__table__{{$table->status}}">
        </form>
        @endforeach
    </div>
</x-dashboard>