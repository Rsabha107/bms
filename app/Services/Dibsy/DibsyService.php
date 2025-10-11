<?php

namespace App\Services\Dibsy;

use Illuminate\Support\Facades\Http;

class DibsyService
{
    protected $apiKey;
    protected $apiUrl;

    public function __construct()
    {
        $this->apiKey = config('services.dibsy.api_key');
        $this->apiUrl = 'https://api.dibsy.one/v2';
    }

    public function createPayment($amount, $currency, $redirectUrl, $description, $method)
    {
        // $data = [
        //     'amount' => [
        //         'currency' => $currency,
        //         'value' => number_format($amount, 2, '.', ''),
        //         // 'value' => $amount,
        //     ],
        //     'redirectUrl' => $redirectUrl,
        //     'description' => 'Payment for order #12345',
        //     'method' => 'naps',
        // ];

        // dd($this->apiKey);
        // dd(json_encode($data));
        $response = Http::withToken($this->apiKey)->post("{$this->apiUrl}/payments", [
            'amount' => ['currency' => $currency, 'value' => number_format($amount, 2, '.', '')],
            // 'currency' => $currency,
            'redirectUrl' => $redirectUrl,
            'description' => $description,
            'method' => $method,
        ]);

        // dd($response->json());
        return $response->json();
    }
}
