<?php
// app/Services/WasteDetectionService.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class WasteDetectionService
{
    protected $aiEndpoint;

    public function __construct()
    {
        $this->aiEndpoint = env('AI_SERVICE_ENDPOINT', 'http://127.0.0.1:5000');
    }

    public function detectWaste($imageFile)
    {
        try {
            // Store the uploaded image temporarily
            $imagePath = $imageFile->store('temp', 'public');

            // Send image to AI service
            $response = Http::attach(
                'image', 
                file_get_contents(Storage::disk('public')->path($imagePath)), 
                basename($imagePath)
            )->post("{$this->aiEndpoint}/predict");

            if (!$response->successful()) {
                throw new \Exception('Failed to process image');
            }

            $result = $response->json();

            // Create detection data
            $detectionData = [
                'user_id' => auth()->id(),
                'image_path' => $imagePath,
                'waste_type' => $result['prediction_label'],
                'confidence_score' => $result['confidence_score'] ?? 0,
                'recycle_info' => $result['recycle_info'],
                'created_at' => now()->toDateTimeString(),
                'points_earned' => $result['points_earned'] ?? 10
            ];

            // Update user points
            $user = auth()->user();
            $user->points += $detectionData['points_earned'];
            $user->save();

            return [
                'status' => 'success',
                'data' => $detectionData,
                'document_id' => uniqid() // temporary ID
            ];

        } catch (\Exception $e) {
            \Log::error('Waste detection error: ' . $e->getMessage());
            throw $e;
        } finally {
            // Cleanup temporary image
            if (isset($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    public function getDetectionHistory($userId = null)
    {
        // Temporary: return empty array
        return [];
    }
}