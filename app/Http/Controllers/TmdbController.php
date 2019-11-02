<?php

namespace App\Http\Controllers;

use App\Models\CategoriesSeries;
use App\Models\Serie;
use Tymon\JWTAuth\JWTAuth;

class TmdbController extends Controller
{


    public function fillSeriesWithTMDB()
    {
        $urlImage = 'https://image.tmdb.org/t/p/w500/';
        $lang = 'fr-FR';
        $apiKey = 'cf4fe60a904bbb135ef155c21e68d143';
        $contents = file_get_contents('https://api.themoviedb.org/3/tv/popular?api_key=' . $apiKey .'&language='.$lang.'&page=1');
        $contents = json_decode($contents, true);
        $totalPage = $contents['total_pages'];
        for ($currentPage = 1; $currentPage <= $totalPage; $currentPage++) {
            $contents = file_get_contents('https://api.themoviedb.org/3/tv/popular?api_key=' . $apiKey .'&language='.$lang.'&page='.$currentPage);
            $contents = json_decode($contents, true);
            foreach($contents['results'] as $result){
                $country = null;
                if(isset($result['origin_country'][0])) $country = $result['origin_country'][0];
                $first_air_date = null;
                if(isset($result['first_air_date'])) $first_air_date = $result['first_air_date'];
                $data = [
                    'see_original_name' => $result['original_name'],
                    'see_original_country' => $country,
                    'see_first_air_date' => $first_air_date,
                    'see_original_lang' => $result['original_language'],
                    'see_tmdb_id' => $result['id'],
                    'see_overview' => $result['overview'],
                    'see_poster_path' => $urlImage . $result['poster_path'],
                    'see_backdrop_path' => $urlImage . $result['backdrop_path'],
                ];
                $serie = Serie::create($data);
                $serieId = $serie->id;
                foreach($result['genre_ids'] as $cat){
                    $dataCatSeries = [
                        'cae_see_serie' => $serieId,
                        'cae_see_category' => $cat,
                    ];
                    $categoriesSeries = CategoriesSeries::create($dataCatSeries);
                }
            }
        }
    }

    private function getTMDBSeries($index){


    }
}
