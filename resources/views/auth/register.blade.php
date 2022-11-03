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
    <form action="/register" method="POST">
        @csrf
        <label for="email">name</label>
        <input id="email" name="name" type="text">
        <label for="email">Email</label>
        <input id="email" name="email" type="text">
        <label for="password">Password</label>
        <input id="password" name="password" type="password">
        <label for="password">Password</label>
        <input id="password" name="password_confirmation" type="password">
        <input type="submit" value="Iniciar Sesión">
    </form>
    <x-partials.footer :items="$items"></x-partials.footer>
</x-layout>