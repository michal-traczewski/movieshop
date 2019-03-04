@extends('layouts.main')
@section('content')  
    
    @foreach($films as $film)
        <?php $position = (($loop->iteration % 2) == 0) ? 'film-box--right' : 'film-box--left'; ?>
        @include('partials.films.film_tile')
    @endforeach
    
    {{$films->links()}}
        
@endsection