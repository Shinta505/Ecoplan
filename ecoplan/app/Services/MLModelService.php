<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MLModelService
{
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->apiUrl = config('waste-detection.api_url');
        $this->apiKey = config('waste-detection.api_key');
    }

    public function detectWaste($imageData)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Accept' => 'application/json',
            ])->post($this->apiUrl, [
                'image' => base64_encode($imageData)
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            Log::error('ML Model API Error', [
                'status' => $response->status(),
                'response' => $response->json()
            ]);

            throw new \Exception('Failed to process image');
        } catch (\Exception $e) {
            Log::error('ML Model Service Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
