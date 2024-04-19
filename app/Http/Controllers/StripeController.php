<?php

namespace App\Http\Controllers;

use App\Models\StripePlan;
use App\Models\Subscription as ModelsSubscription;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Customer;
use Stripe\Stripe;
use Stripe\Subscription;

class StripeController extends Controller
{
    public function plan()
    {
        $plans = StripePlan::all();
        return view('subscribe',compact('plans'));
    }
    public function subscribe(Request $request)
    {
        try {
            DB::beginTransaction();

            // Check if the user is already subscribed
            if (Auth::check()) {
                $existingSubscription = ModelsSubscription::where('user_id', Auth()->user()->id)->first();
                if ($existingSubscription) {
                    return response()->json(['error' => 'User is already subscribed.'], JsonResponse::HTTP_BAD_REQUEST);
                }
            }


            $data = $request->session()->get('business');
            Stripe::setApiKey(env('STRIPE_SECRET'));
            // create customer
            $user = Auth::user();
            $customer = Customer::create([
                'email' => $user->email,
                'payment_method' => $request->payment_method,
            ]);
            $customer->invoice_settings->default_payment_method = $request->payment_method;
            $customer->save();
            $plan  = StripePlan::find($request->plan_id);
            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => $plan->stripe_plan_id,
                    ],
                ],
            ]);
            if ($subscription) {
                // after subscription create a record in database
                $subscribe = new ModelsSubscription;
                $subscribe->subscription_id = $subscription->id;
                $subscribe->user_id = Auth()->user()->id ?? 1;
                $subscribe->plain_id = $request->plan_id;
                $subscribe->stripe_customer_id = $subscription->customer;
                $subscribe->status = "paid";
                $subscribe->save();

                // store plan id into user
                $user->selected_plan_id =  $request->plan_id;
                $user->save();
            }
            DB::commit();
            return response()->json(['success' => true, 'redirect_url' => route('plan')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
