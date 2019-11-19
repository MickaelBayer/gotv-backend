<?php

namespace App\Http\Controllers;

use App\Models\CategoriesSeries;
use Illuminate\Http\Request;

class CategoriesSeriesController extends Controller
{
    public function PostCategoriesSerie(Request $request)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'cae_see_serie' => 'required|integer',
                'cae_see_category' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $event = new CategoriesSeries();
        $event->cae_see_serie = $request->cae_see_serie;
        $event->cae_see_category = $request->cae_see_category;
        $event->save();
        return $event;
    }
}
