<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PaymentController extends Controller
{
    public function paymeePost(Request $request){

     // URL
        $apiURL ='https://sandbox.paymee.tn/api/v1/payments/create';
         $amount=$request->amount;
        // POST Data
        $postInput = [
          'vendor'=> 2510,
          'amount'=>$amount,
          'note' =>"test"
        ];
        // Headers
        $headers = [
             'Content-Type' =>' application/json',
             'Authorization' => 'Token 1e432f287b53b26879a15a5440bb3ed9166e85b7',
        ];
  
        $response = Http::withHeaders($headers)->post($apiURL, $postInput);
  
        $statusCode = $response->status();
       return $response->json();
        //echo $statusCode;  // status code

        //dd($responseBody); // body response
    }
    

    
}
