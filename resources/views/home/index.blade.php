@php
$items = [
['route'=> '/nosotros', 'text' => 'Nosotros'],
['route'=> '/especialidades', 'text' => 'Especialidades'],
['route'=> '/menu', 'text' => 'Menú'],
['route'=> '/contacto', 'text' => 'Contacto'],

['route'=> '/login', 'text' => 'Login'],
];
@endphp
<x-layout>
    <x-partials.header :items="$items"></x-partials.header>
    <div class="home-categories">
        <h2 class="home-categories__title">Categorías</h2>

        <div class="glider-contain">
            <div class="glider ">
                @foreach ($categories as $category)
                <a href="{{route('home.show',$category)}}" class="home-categories__card">
                    <img class="card__image" src="../img/categories/{{$category->image}}" alt="">
                    <p class="card__name">{{$category->name}}</p>
                </a>
                @endforeach
            </div>

            <button aria-label="Previous" class="glider-prev">❮</button>
            <button aria-label="Next" class="glider-next">❯</button>
            <div role="tablist" class="dots"></div>
        </div>
    </div>
{{--     <x-categories :categories="$categories" /> --}}
    <section class="nosotros">
        <h2 class="nosotros__title">Nosotros</h2>
        <div class="flex">
            <img src="../img/anillo.jpg" alt="" class="nosotros__img">
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id
                    laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit.</p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id
                    laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit.</p>
                <br>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit. Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi placeat id
                    laudantium dicta fuga
                    blanditiis qui repudiandae tenetur in quasi, modi, sit vel itaque similique vero! Repellat quam
                    error suscipit.</p>
            </div>
        </div>
    </section>
    <x-partials.footer :items="$items"></x-partials.footer>
</x-layout>