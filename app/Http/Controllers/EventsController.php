<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function getAllEvents()
    {
        $event = Event::with('evt_plm_id')->get();
        return $event;
    }

    public function getEventById(int $id)
    {
        $event = Event::find($id);
        return $event;
    }

    public function postEvent(Request $request)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'evt_plm_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $event = new Event();
        $event->evt_plm_id = $request->evt_plm_id;
        $event->save();
        return $event;
    }

    public function putEventById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'evt_plm_id' => 'required|integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $event = Event::find($id);
        $event->evt_plm_id = $request->evt_plm_id;
        $event->save();
        return $event;
    }

    public function deleteEventById(int $id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
