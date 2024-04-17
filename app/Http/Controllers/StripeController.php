<?php

namespace App\Http\Controllers;

use App\Models\Stripe as ModelsStripe;
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
        return view('subscribe');
    }
    public function subscribe(Request $request)
    {
        try {
            DB::beginTransaction();

            // Check if the user is already subscribed
            if (Auth::check()) {
                $existingSubscription = ModelsStripe::where('user_id', Auth()->user()->id)->first();
                if ($existingSubscription) {
                    return response()->json(['error' => 'User is already subscribed.'], JsonResponse::HTTP_BAD_REQUEST);
                }
            }


            $data = $request->session()->get('business');
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create([
                'email' => "test@gmail.com",
                'payment_method' => $request->payment_method,
            ]);
            $customer->invoice_settings->default_payment_method = $request->payment_method;
            $customer->save();

            $subscription = Subscription::create([
                'customer' => $customer->id,
                'items' => [
                    [
                        'price' => $request->plan_id,
                    ],
                ],
            ]);
            if ($subscription) {
                $subscribe = new ModelsStripe;
                $subscribe->subscription_id = $subscription->id;
                $subscribe->user_id = Auth()->user()->id ?? 1;
                $subscribe->plain_id = $request->plan_id;
                $subscribe->stripe_customer_id = $subscription->customer;
                $subscribe->status = "paid";
                $subscribe->save();
            }
            DB::commit();
            return response()->json(['success' => true, 'redirect_url' => route('subscribe')]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
