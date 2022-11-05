<a href="{{route('home.dish', ['id' => $dish->id])}}" class="flex dish__card">
    <img src="../img/dishes/{{$dish->image}}" alt="Imagen Platillo" class="dish__image">
    <div>
        <p class="dish__card__name">{{$dish->name}}</p>
        <p class="dish__card__price"><span>$</span> {{$dish->price}}</p>
        <p class="dish__card__price"><span>Calorías: </span>{{$dish->cal}}</p>
    </div>
</a>