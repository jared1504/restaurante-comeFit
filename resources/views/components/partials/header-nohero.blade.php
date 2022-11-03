<header class="header-nohero">
    <section class="navigation">
        <a href="/">
            <img class="navigation__logo" src="images/logo.png" alt="">
        </a>
        @php
        $items = [
        ['route'=> '/about', 'text' => 'about'],
        ['route'=> '/users', 'text' => 'users'],
        ['route'=> '/menu', 'text' => 'Menú'],

        ];
        @endphp
        <x-utils.nav class="navigation__nav-bar" :items="$items"></x-utils.nav>
        <button class="navigation__cta navigation__cta__black">Reserva</button>

    </section>
    <section class="titulo-header">
        <h2>ComeFIT</h2>
    </section>
</header>