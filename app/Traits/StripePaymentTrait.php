<?php

namespace App\Traits;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\PaymentIntent;

trait StripePaymentTrait
{
    /**
     * Create a Stripe Checkout Session
     *
     * @param array $data
     * @return \Stripe\Checkout\Session
     */
    public function createStripeCheckout(array $data)
    {
        
        $amount      = $data['amount'];       
        $name        = $data['name'];
        $description = $data['description'];
        $images      = $data['images']; // array
        $metadata    = $data['metadata']; // array
        $success_url = $data['success_url'];
        $cancel_url  = $data['cancel_url'];

        Stripe::setApiKey(STRIPE_SECRET);

        try{
            return Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => STRIPE_CURRENCY,
                        'product_data' => [
                            'name' => $name,
                            'description' => $description,
                            'images' => $images,
                        ],
                        'unit_amount' => $amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                // 'metadata' => [
                //     'order_id' => 1234,
                //     'user_id'  => 56,
                //     'my_note'  => "This is demo note",
                // ],
                'metadata' => $metadata,
                'success_url' => $success_url,
                'cancel_url' => $cancel_url,
            ]);
        }
        catch (\Stripe\Exception\ApiConnectionException $e) {
            // Stripe server / network issue
            return back()->with('error', 'Payment server not responding. Please try again.');
        }
        catch (\Stripe\Exception\ApiErrorException $e) {
            // Stripe internal error
            return back()->with('error', 'Payment could not be initiated. Try after some time.');
        }

        catch (\Exception $e) {
            // Other errors
            return back()->with('error', 'Unexpected error! Please try later.');
        }
    }

    public function verifyStripeSuccess($sessionId){

        Stripe::setApiKey(STRIPE_SECRET);

        $session = Session::retrieve($sessionId);

        if ($session->payment_status == 'paid') {
            $paymentIntent = PaymentIntent::retrieve($session->payment_intent);

            if($paymentIntent->status == 'succeeded'){

                return ([
                    'success' => true,
                    'status' => $paymentIntent->status,
                    'paymentIntentId' => $session->payment_intent,
                    'paymentMode' => ($session->mode == 'payment')?'Stripe':'',
                    'meta' => $session->metadata->toArray(),
                    
                ]);
            }else{
                    return ([
                    'success' => false,
                    'status' => $paymentIntent->status,
                ]);
            }
        }else{
            return ([
                'success' => false,
                'status' => $session->payment_status,
            ]);
        }

       
    }
}
