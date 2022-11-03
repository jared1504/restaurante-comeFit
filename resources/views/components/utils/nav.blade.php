<section class="nav-component">
  @foreach ($items as $item)
  <a class="nav-component__item" href="{{ $item['route'] }}">
    <p>{{ $item['text'] }}</p>
  </a>
  @endforeach
</section>