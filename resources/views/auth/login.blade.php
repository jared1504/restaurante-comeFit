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
    <div class="login">

        <form action="{{route('login')}}" method="POST" class="form form__login mt-5">
            @csrf
            <h2 class="login__title">Iniciar Sesión</h2>
            <div class="form__item">
                <label class="form__label" for="email">Email</label>
                <input class="form__input" id="email" name="email" type="text">
                @error('email')
                <div class="form__error">{{$message}}</div>
                @enderror
            </div>
            <div class="form__item">
                <label class="form__label" for="password">Password</label>
                <input class="form__input" id="password" name="password" type="password">
                @error('password')
                <div class="form__error">{{$message}}</div>
                @enderror
            </div>
            <div class="form__submit">
                <input class="form__submit__input" type="submit" value="Iniciar Sesión">
            </div>
        </form>
    </div>
    <x-partials.footer :items="$items"></x-partials.footer>
</x-layout>