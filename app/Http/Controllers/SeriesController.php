<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllSeries()
    {
        $serie = Serie::get();
        return $serie;
    }

    public function getSerieById(int $id)
    {
        $serie = Serie::find($id);
        return $serie;
    }

    public function postSerie(Request $request)
    {
        try {
            $this->validate($request, [
                'see_cae_id' => 'required|integer',
                'see_plm_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $serie = new Serie();
        $serie->see_cae_id = $request->see_cae_id;
        $serie->see_plm_id = $request->see_plm_id;
        $serie->save();
        return $serie;
    }

    public function putSerieById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'see_cae_id' => 'required|integer',
                'see_plm_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $serie = Serie::find($id);
        $serie->see_cae_id = $request->see_cae_id;
        $serie->see_plm_id = $request->see_plm_id;
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
