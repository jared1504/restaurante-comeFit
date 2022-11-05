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
    <div class="mx-5 py-3 flex">
        <div class="dish flex ">
            <img src="../img/dishes/{{$dish->image}}" alt="Imagen Platillo" class="dish__image">
            <div>
                <h2 class="dish__name">{{$dish->name}}</h2>
                <p class="dish__price"><span>Precio: $</span> {{$dish->price}}</p>
                <p class="dish__cal"><span>Calorías:</span> {{$dish->cal}}</p>
                <p class="dish__description">{{$dish->description}}</p>
            </div>
        </div>
        <aside class="dish__aside">
            <h3 class="dish__aside__title">Relacionados</h3>
            @foreach ($dishes as $dish)
            <x-home.dish_aside :dish="$dish" />
            @endforeach
        </aside>
    </div>
    <x-categories :categories="$categories"></x-categories>
    <x-partials.footer :items="$items" />
</x-layout>