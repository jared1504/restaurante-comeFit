<a href="{{route('home.dish', ['id' => $dish->id])}}" class="card-product">
    <img class="card-product__image" src="../img/{{$dish->image}}.jpg" alt="">
    <p class="card-product__name">{{$dish->name}}</p>
    <p class="card-product__price"><span>$</span> {{$dish->price}}</p>
    <p class="card-product__cal"><span>Calorías:</span> {{$dish->cal}}</p>
</a>