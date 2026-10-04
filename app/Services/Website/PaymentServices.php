<?php

namespace App\Services\Website;

use Illuminate\Support\Facades\Http;

class PaymentServices
{
    private $base_url, $headers;
    public function __construct()
    {
        $this->base_url = config('services.myfatoorah.base_url');
        $this->headers = [
            'Authorization' => 'Bearer ' . config('services.myfatoorah.token'),
        ];
    }
    public function createRequest($method, $url, $body = [])
    {
        if (empty($body)) {
            return false;
        }
        $responce = Http::withHeaders($this->headers)
            ->timeout(30)
            ->withoutVerifying()
            ->acceptJson()
            ->send($method, $this->base_url . $url, [
                'json' => $body
            ]);
        if (!$responce->successful()) {
            return false;
        }
        return $responce->json();
    }

    public function checkout($data)
    {
        return $this->createRequest('POST', 'v2/SendPayment', $data);
    }
    public function getPaymentStatus($data)
    {
        return $this->createRequest('POST', 'v2/GetPaymentStatus', $data);
    }
}
