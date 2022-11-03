<nav class="nav-categories">
    @foreach ($categories as $cat)
    <a href="{{route('home.show', ['id' => $cat->id])}}" class="nav-categories__item">
        {{$cat->name}}
    </a>
    @endforeach
</nav>
