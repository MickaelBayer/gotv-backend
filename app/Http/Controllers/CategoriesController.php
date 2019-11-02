<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllCatSeries()
    {
        $catSerie = Categories::get();
        return $catSerie;
    }

    public function getCatSerieById(int $id)
    {
        $catSerie = Categories::find($id);
        return $catSerie;
    }

    public function postCatSerie(Request $request)
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

        $catSerie = new Categories();
        $catSerie->save();
        return $catSerie;
    }

    // public function putCatSerieById(Request $request, int $id)
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

    //     $catSerie = Categories::find($id);
    //     $catSerie->save();
    //     return $catSerie;
    // }

    public function deleteCatSerieById(int $id)
    {
        $catSerie = Categories::find($id);
        $catSerie->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
