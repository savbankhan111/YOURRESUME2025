<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Braintree\Gateway;
use Illuminate\Http\Response;

class PaymentController extends Controller
{
    public function generateClientToken()
    {
        $gateway = new Gateway([
            'environment' => 'production',
            'merchantId' => 'rvpzxkxs9qg5dfkt',
            'publicKey' => 'bvqxyp4cqqsrhnwq',
            'privateKey' => 'c36a5272fc2506211a7122f0656a855d'
        ]);

     
        
        // $gateway = new Gateway([
        //     'environment' => 'sandbox',
        //     'merchantId' => '849h58wbn8bykvw4',
        //     'publicKey' => 'htr27wkztk359g2b',
        //     'privateKey' => '92ef0a3b80c2a6eff924eece7446e833'
        // ]);

        
        $clientToken = $gateway->clientToken()->generate();
        return response()->json(['data' => $clientToken], Response::HTTP_OK);

     
    }

    public function processPayment(Request $request)
    {

        $gateway = new Gateway([
            'environment' => 'production',
            'merchantId' => 'rvpzxkxs9qg5dfkt',
            'publicKey' => 'bvqxyp4cqqsrhnwq',
            'privateKey' => 'c36a5272fc2506211a7122f0656a855d'
        ]);


        // $gateway = new Gateway([
        //     'environment' => 'sandbox',
        //     'merchantId' => '849h58wbn8bykvw4',
        //     'publicKey' => 'htr27wkztk359g2b',
        //     'privateKey' => '92ef0a3b80c2a6eff924eece7446e833'

          
        // ]);

        $result = $gateway->transaction()->sale([
            'amount' => $request->amount,
            'paymentMethodNonce' => $request->nonce,
            'deviceData' => $request->deviceData,
            'options' => [
              'submitForSettlement' => True
            ]
          ]);

          
        if ($result->success) {
            // Transaction successful
            return response()->json(['status' => 'success'], Response::HTTP_OK);
        } else {
            // Log or handle errors more specifically
            $errorMessages = [];
                    foreach ($result->errors->deepAll() as $error) {
            }

            return response()->json(['status' => 'error', 'errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }
    }
}
