@php
$items = [
['route'=> '/nosotros', 'text' => 'Nosotros'],
['route'=> '/especialidades', 'text' => 'Especialidades'],
['route'=> '/menu', 'text' => 'Menú'],
['route'=> '/contacto', 'text' => 'Contacto'],
];
@endphp
<x-layout>
    <x-partials.header :items="$items"></x-partials.header>
    <x-categories :categories="$categories"></x-categories>
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