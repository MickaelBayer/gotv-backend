<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /*    public function __construct()
    {
        $this->middleware('auth:api');
    }*/

    public function getAllSeries()
    {
        $serie = Serie::with("see_categories")->get();
        return $serie;
    }

    public function getSerieById(int $id)
    {
        $serie = Serie::with("see_categories")->find($id);
        return $serie;
    }

    public function postSerie(Request $request)
    {
        try {
            $this->validate($request, [
                'see_name' => 'required',
                'see_tmdb_id' => 'required',
                'see_original_country' => 'required',
                'see_first_air_date' => 'required',
                'see_original_lang' => 'required',
                'see_overview' => 'required',
                'see_poster_path' => 'required',
                'see_backdrop_path' => 'required'

            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $serie = new Serie();
        $serie->see_name = $request->see_name;
        $serie->see_tmdb_id = $request->see_tmdb_id;
        $serie->see_original_country = $request->see_original_country;
        $serie->see_first_air_date = $request->see_first_air_date;
        $serie->see_original_lang = $request->see_original_lang;
        $serie->see_overview = $request->see_overview;
        $serie->see_poster_path = $request->see_poster_path;
        $serie->see_backdrop_path = $request->see_backdrop_path;
        $serie->save();
        return $serie;
    }



    public function putSerieById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'see_name' => 'required',
                'see_tmdb_id' => 'required',
                'see_original_country' => 'required',
                'see_first_air_date' => 'required',
                'see_original_lang' => 'required',
                'see_overview' => 'required',
                'see_poster_path' => 'required',
                'see_backdrop_path' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $serie = Serie::find($id);
        $serie->see_name = $request->see_name;
        $serie->see_tmdb_id = $request->see_tmdb_id;
        $serie->see_original_country = $request->see_original_country;
        $serie->see_first_air_date = $request->see_first_air_date;
        $serie->see_original_lang = $request->see_original_lang;
        $serie->see_overview = $request->see_overview;
        $serie->see_poster_path = $request->see_poster_path;
        $serie->see_backdrop_path = $request->see_backdrop_path;
        $serie->save();
        return $serie;
    }



    public function deleteSerieById(int $id)
    {
        $serie = Serie::find($id);
        $serie->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
