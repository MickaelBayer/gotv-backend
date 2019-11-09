<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api');
    }

    public function getAllVotes()
    {
        $vote = Vote::with('serie', 'user')->get();
        return $vote;
    }

    public function getVoteById(int $id)
    {
        $vote = Vote::find($id);
        return $vote;
    }

    public function postVote(Request $request)
    {
        try {
            $this->validate($request, [
                'voe_see_id' => 'required|integer',
                'voe_usr_id' => 'integer',
                'voe_mark' => 'required'

            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $vote = new Vote();
        $vote->voe_see_id = $request->voe_see_id;
        $vote->voe_usr_id = $request->voe_usr_id;
        $vote->voe_comment = $request->voe_comment;
        $vote->voe_mark = $request->voe_mark;
        $vote->save();
        return $vote;
    }

    public function putVoteById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'voe_see_id' => 'required|integer',
                'voe_usr_id' => 'integer',
                'voe_mark' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $vote = Vote::find($id);
        $vote->voe_see_id = $request->voe_see_id;
        $vote->voe_usr_id = $request->voe_usr_id;
        $vote->voe_comment = $request->voe_comment;
        $vote->voe_mark = $request->voe_mark;
        $vote->save();
        return $vote;
    }

    public function deleteVoteById(int $id)
    {
        $vote = Vote::find($id);
        $vote->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
