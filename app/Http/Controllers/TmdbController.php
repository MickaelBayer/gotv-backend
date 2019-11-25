<?php

namespace App\Http\Controllers;

use App\Models\CategoriesSeries;
use App\Models\Serie;
use App\Models\SerieCast;
use App\Models\SerieVideo;
use App\Models\Vote;

class TmdbController extends Controller
{
    private $lang = 'fr-FR';

    public function fillSeries()
    {
        $urlPosterImage = 'https://image.tmdb.org/t/p/w500/';
        $urlBackdropImage = 'https://image.tmdb.org/t/p/original/';
        $urlWithEndpoint = getenv('TMDB_ADDRESS') . '/tv/top_rated';
        $contents = $this->getResJsonFormat($urlWithEndpoint . '?api_key=' . getenv('TMDB_TOKEN') . '&language=' . $this->lang . '&page=1');
        $totalPage = $contents['total_pages'];

        for ($currentPage = 1; $currentPage <= $totalPage; $currentPage++) {
            $contents = $this->getResJsonFormat($urlWithEndpoint . '?api_key=' . getenv('TMDB_TOKEN') . '&language=' . $this->lang . '&page=' . $currentPage);
            foreach ($contents['results'] as $result) {
                sleep(0.5);
                $country = null;
                $first_air_date = null;

                if (isset($result['origin_country'][0])) $country = $result['origin_country'][0];

                if (isset($result['first_air_date'])) $first_air_date = $result['first_air_date'];

                $data = [
                    'see_name' => $result['name'],
                    'see_original_country' => $country,
                    'see_first_air_date' => $first_air_date,
                    'see_original_lang' => $result['original_language'],
                    'see_tmdb_id' => $result['id'],
                    'see_overview' => $result['overview'],
                    'see_poster_path' => $urlPosterImage . $result['poster_path'],
                    'see_backdrop_path' => $urlBackdropImage . $result['backdrop_path'],
                ];
                $serie = Serie::create($data);
                $serieId = $serie->id;

                foreach ($result['genre_ids'] as $cat) {
                    $dataCatSeries = [
                        'cae_see_serie' => $serieId,
                        'cae_see_category' => $cat,
                    ];
                    CategoriesSeries::create($dataCatSeries);
                }

                for ($mark = 1; $mark <= $result['vote_count']; $mark++) {
                    $dataVote = [
                        'voe_mark' => $result['vote_average'],
                        'voe_see_id' => $serieId
                    ];
                    Vote::create($dataVote);
                }
            }
        }
    }

    public function getVideosBySerieId(int $serieId)
    {
        $urlWithEndpoint = getenv('TMDB_ADDRESS') . '/tv/' . $serieId . '/videos';
        $contents = $this->getResJsonFormat($urlWithEndpoint . '?api_key=' . getenv('TMDB_TOKEN'));
        $serieVideos = array();
        foreach ($contents['results'] as $result) {
            array_push($serieVideos, new SerieVideo($result['id'], $result['key'], $result['name'], $result['type']));
        }
        return response()->json($serieVideos);
    }

    public function getCastsBySerieId(int $serieId)
    {
        $urlWithEndpoint = getenv('TMDB_ADDRESS') . '/tv/' . $serieId . '/credits';
        $contents = $this->getResJsonFormat($urlWithEndpoint . '?api_key=' . getenv('TMDB_TOKEN'));
        $serieCasts = array();
        foreach ($contents['cast'] as $result) {
            array_push($serieCasts, new SerieCast($result['id'], $result['character'], $result['name'], $result['profile_path'], $result['order']));
        }
        return response()->json($serieCasts);
    }
}
