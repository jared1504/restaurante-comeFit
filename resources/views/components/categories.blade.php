<div class="home-categories">
    <h2 class="home-categories__title">Categorías</h2>
    <div class="flex">
        @foreach ($categories as $category)
        <a href="{{route('home.show',$category)}}" class="home-categories__card">
            <img class="card__image" src="../img/categories/{{$category->image}}" alt="">
            <p class="card__name">{{$category->name}}</p>
            <p>{{$category->description}}</p>
        </a>

        @endforeach

    </div>
</div>