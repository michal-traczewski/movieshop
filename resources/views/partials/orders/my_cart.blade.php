@if (count($films) == 0)
    <h3> Nothing to display </h3>
@else
    <?php $price = 0; ?>
    @foreach ($films as $film)
        <?php $price = $price + $film->price; ?>
        <?php $position = (($loop->iteration % 2) == 0) ? 'film-box--right' : 'film-box--left'; ?>
        @include('partials.films.film_tile')
    @endforeach
    <div id="BasketFooter">
        TOTAL: &#163;{{ $price }} <br/><br/>
    <a href="/myorders/cart/clear">
        <button class="btn btn-danger">
            <span class="glyphicon glyphicon-remove" ></span>Clear basket
        </button>
    </a><br/><br/>
    <a href="/myorders/cart/checkout">
        <button class="btn btn-primary">
            <span class="glyphicon glyphicon-ok" ></span>Checkout
        </button>
    </div>
@endif