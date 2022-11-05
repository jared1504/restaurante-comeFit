<x-layout>
    <div class="flex dashboard">
        <div class="dashboard__aside">
            <div class="flex dashboard__logo">
                <img src="../../img/logo.png" alt="Imagen logo">
                <h2>ComeFit</h2>
            </div>
            <nav>
                <a class="dashboard__nav__item" href="{{route('sale.index')}}">Ventas</a>
                <a class="dashboard__nav__item" href="{{route('dish.index')}}">Platillos</a>
                <a class="dashboard__nav__item" href="{{route('category.index')}}">Categorías</a>
                <a class="dashboard__nav__item" href="{{route('ingredient.index')}}">Ingredientes</a>
                <a class="dashboard__nav__item" href="{{route('order.index')}}">Pedidos</a>
                <a class="dashboard__nav__item" href="{{route('supplier.index')}}">Proveedores</a>
                <a class="dashboard__nav__item" href="{{route('table.index')}}">Mesas</a>
                <a class="dashboard__nav__item" href="{{route('user.index')}}">Empleados</a>
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <input type="submit" value="Cerrar Sesión" class="dashboard__nav__item dashboard__nav__cerrar">
                </form>
            </nav>
        </div>
        <div class="dashboard__body">

            <section class="dashboard__body__nav">
                @foreach ($items as $item)
                <a class="dashboard__body__nav__item dashboard__nav__item" href='{{route($item['route'])}}'>
                    <p>{{ $item['text'] }}</p>
                </a>
                @endforeach
            </section>
            <div class="dashboard__slot">
                 {{$slot}}
            </div>
           
        </div>
    </div>
</x-layout>