<div class="jumbotron film-box--detail">
    <a href="/films/details/id/{{ $film->film_id }}"><img src="/images/films/{{ $film->film_id }}.jpg" width="100" height="100"/></a>
    <div class="title">{{ ucfirst($film->title) }}</div> 
    <div class="description">{{ $film->description }}</div>
    <div class="description"><b>Duration: </b>{{ $film->length }} <b>Language:</b> {{ $film->language }}  <b>Rating:</b> {{ $film->rating }}</div>
    @if ($user_id)
        @if (isset($cart) && in_array($film->film_id, array_column($cart->all(), 'film_id')))
            <p class="add-to-basket">IN BASKET</p>
        @else
            <p class="add-to-basket"><a href="/myorders/cart/add/{{ $film->film_id }}">ADD TO BASKET</a></p>
        @endif
    @endif
</div>