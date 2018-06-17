@extends('layouts.main')
@section('content')

    @if ($filter['searchPhrase'])
        <h3><i>Results for: {{ $filter['searchPhrase'] }}</i></h3>
    @endif
    
    @foreach($films as $film)
        <?php $position = (($loop->iteration % 2) == 0) ? 'film-box--right' : 'film-box--left'; ?>
        @include('partials.films.film_tile')
    @endforeach
    
    <div id="pager">
        @include('partials.page_num_bar')
    </div>
        
@endsection