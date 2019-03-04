<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class FilmService
{   
    public function getFilmById($id)
    {
        return DB::table('film')
        ->leftJoin('language AS lang', 'film.language_id', 'lang.language_id')
        ->where('film_id', '=', $id)
        ->select('film.film_id',
                'film.title',
                'film.description',
                'film.release_year',
                'film.rental_duration',
                'film.rental_rate',
                'film.price',
                'film.length',
                'film.replacement_cost',
                'film.rating',
                'film.special_features',
                'lang.name as language'
                )->get()->first();
    }

    public function getAllFilms()
    {
        return DB::table('film')
        ->leftJoin('language AS lang', 'film.language_id', 'lang.language_id')
        ->select('film.film_id',
                'film.title',
                'film.description',
                'film.release_year',
                'film.rental_duration',
                'film.rental_rate',
                'film.price',
                'film.length',
                'film.replacement_cost',
                'film.rating',
                'film.special_features',
                'lang.name as language'
                )->get();
}
    
    public function getFilteredList($filter)
    {
        return DB::table('film')
        ->leftJoin('language AS lang', 'film.language_id', 'lang.language_id')
        ->where('description', 'like', '%' . $filter['searchPhrase'] . '%')
        ->orWhere('title', 'like', '%' . $filter['searchPhrase'] . '%')
        ->select(
            'film.film_id',
            'film.title',
            'film.description',
            'film.release_year',
            'film.rental_duration',
            'film.rental_rate',
            'film.price',
            'film.length',
            'film.replacement_cost',
            'film.rating',
            'film.special_features',
            'lang.name as language'
            )->orderBy('film_id')
            ->skip(($filter['pageNumber']-1) * $filter['recordsOnPage'])
            ->take($filter['recordsOnPage'])->get();
    }
    
    public function setFilmsListParams($urlParams)
    {
         $searchPhrase = isset($urlParams['searchPhrase']) ? $urlParams['searchPhrase'] : '';
        
//        if (isset($urlParams['recordsOnPage']) && in_array($urlParams['recordsOnPage'], self::RECORDS_ON_PAGE_DROPLIST_VALUES)){
//            $recordsOnPage = $urlParams['recordsOnPage'];
//        } else {
//            $recordsOnPage = self::RECORDS_ON_PAGE;
//        }
        
// delete me!       
//        if (isset($urlParams['page']) && $urlParams['page']){
//            $pageNumber = $urlParams['page'];
//        } else {
//            $pageNumber = 1;
//        }
        
//        $movieCount = DB::table('film')
//        ->leftJoin('language AS lang', 'film.language_id', 'lang.language_id')
//        ->where('description', 'like', '%' . $searchPhrase . '%')
//        ->orWhere('title', 'like', '%' . $searchPhrase . '%')
//        ->count();
        
        return [
            'searchPhrase' => $searchPhrase,
        ];
    }
}

