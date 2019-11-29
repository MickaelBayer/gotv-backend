<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class VotesController extends Controller
{
    public function getAllVotes()
    {
        $vote = Vote::with('voe_serie', 'voe_user')->get();
        return $vote;
    }

    public function getVoteById(int $id)
    {
        $vote = Vote::with('voe_serie', 'voe_user')->find($id);
        return $vote;
    }

    public function getVoteBySerie(int $id)
    {
        $vote = Vote::where('voe_see_id', $id)->with('voe_serie', 'voe_user')->get();
        return $vote;
    }

    public function postVote(Request $request)
    {
        $userAlreadyVote = Vote::where('voe_usr_id', $request->input('voe_usr_id'))->where('voe_see_id', $request->input('voe_see_id'))->first();

        if ($userAlreadyVote) {
            return response()->json(['status' => '409', 'error' => 'The user has already voted'], 409);
        }

        try {
            $this->validate($request, [
                'voe_see_id' => 'required|integer',
                'voe_usr_id' => 'required|integer',
                'voe_comment' => 'required',
                'voe_mark' => 'required'
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 422);
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
