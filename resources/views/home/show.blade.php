@php
$items = [
['route'=> '/nosotros', 'text' => 'Nosotros'],
['route'=> '/especialidades', 'text' => 'Especialidades'],
['route'=> '/menu', 'text' => 'Menú'],
['route'=> '/contacto', 'text' => 'Contacto'],
];
@endphp
<x-layout>
    <x-partials.header :items="$items" />
    <x-home.nav_categories :categories="$categories" />
    <div class="page-category">
        <h2 class="page-category__title">{{$category->name}}</h2>
        <div class="grid px-5">
            @foreach ($dishes as $dish)
            <x-home.card_dish :dish="$dish" />
            @endforeach
        </div>
    </div>

    <x-partials.footer :items="$items" />
</x-layout>