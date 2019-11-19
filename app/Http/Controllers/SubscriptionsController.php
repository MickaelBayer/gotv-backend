<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function getAllSubscriptions()
    {
        $subscription = Subscription::get();
        return $subscription;
    }

    public function getSubscriptionById(int $id)
    {
        $subscription = Subscription::find($id);
        return $subscription;
    }

    public function postSubscription(Request $request)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'sun_name' => 'required',
                'sun_price' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 500);
        }

        $subscription = new Subscription();
        $subscription->sun_name = $request->sun_name;
        $subscription->sun_price = $request->sun_price;
        $subscription->save();
        return $subscription;
    }

    public function putSubscriptionById(Request $request, int $id)
    {
        // validation des champs
        try {
            $this->validate($request, [
                'sun_name' => 'required',
                'sun_price' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => '3000', 'message' => $e], 401);
        }

        $subscription = Subscription::find($id);
        $subscription->sun_name = $request->sun_name;
        $subscription->sun_price = $request->sun_price;
        $subscription->save();
        return $subscription;
    }

    public function deleteSubscriptionById(int $id)
    {
        $subscription = Subscription::find($id);
        $subscription->delete();
        return response()->json(['message' => 'Deleted !']);
    }
}
