<?php

namespace App\Http\Controllers;

use App\Models\PlatformSerie;
use Illuminate\Http\Request;

class PlatformSeriesController extends Controller
{
    public function getAllPlatformSeries()
    {
        $platformSerie = PlatformSerie::get();
        return $platformSerie;
    }

    public function getPlatformSerieById(int $id)
    {
        $platformSerie = PlatformSerie::find($id);
        return $platformSerie;
    }

    public function postPlatformSerie(Request $request)
    {
        // validation des champs
        // try {
        //     $this->validate($request, [
        //         'roe_name' => 'required',
        //         'roe_description' => 'required',
        //     ]);
        // } catch (ValidationException $e) {
        //     return response()->json(['error' => '3000', 'message' => $e], 500);
        // }

        $platformSerie = new PlatformSerie();
        $platformSerie->save();
        return $platformSerie;
    }

    // public function putPlatformSerieById(Request $request, int $id)
    // {
    //     // validation des champs
    //     // try {
    //     //     $this->validate($request, [
    //     //         'roe_name' => 'required',
    //     //         'roe_description' => 'required',
    //     //     ]);
    //     // } catch (ValidationException $e) {
    //     //     return response()->json(['error' => '3000', 'message' => $e], 401);
    //     // }

    //     $platformSerie = PlatformSerie::find($id);
    //     $platformSerie->save();
    //     return $platformSerie;
    // }

    public function deletePlatformSerieById(int $id)
    {
        $platformSerie = PlatformSerie::find($id);
        $platformSerie->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
