<div class="jumbotron film-box {{ $position }}">
    <a href="/films/details/id/{{ $film->film_id }}"><img src="/images/films/{{ $film->film_id }}.jpg"/></a>
    <a href="/films/details/id/{{ $film->film_id }}" class="title">{{ ucfirst($film->title) }}</a> 
    <div class="description">{{ $film->description }}</div>
    <div class="description"><b>Duration: </b>{{ $film->length }} <b>Language:</b> {{ $film->language->name }}  <b>Rating:</b> {{ $film->rating }}</div>
    @if ($user_id && isset($films_in_basket))
        @if (isset($films_in_basket) && in_array($film->film_id, $films_in_basket))
            <p class="add-to-basket">IN BASKET</p>
        @else
            <p class="add-to-basket"><a href="/myorders/cart/add/{{ $film->film_id }}">ADD TO BASKET</a></p>
        @endif
    @endif
</div>

