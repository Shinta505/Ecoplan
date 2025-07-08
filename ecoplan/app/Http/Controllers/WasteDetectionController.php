<?php
// app/Http/Controllers/WasteDetectionController.php

namespace App\Http\Controllers;

use App\Services\WasteDetectionService;
use Illuminate\Http\Request;

class WasteDetectionController extends Controller
{
    protected $wasteService;

    public function __construct(WasteDetectionService $wasteService)
    {
        $this->wasteService = $wasteService;
    }

    public function show()
    {
        return view('waste.detect');
    }
    public function process(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // max 5MB
        ]);
    
        try {
            // Simpan gambar ke storage
            $imagePath = $request->file('image')->store('waste-images', 'public');
    
            // Proses deteksi
            $result = $this->wasteService->detectWaste($request->file('image'));
    
            // Simpan image path ke session untuk ditampilkan di result page
            session(['temp_image_path' => $imagePath]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'Image processed successfully',
                'redirect' => route('waste.result', ['id' => $result['document_id']])
            ]);
    
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to process image'
            ], 500);
        }
    }
    
    public function result($id)
    {
        // Ambil image path dari session
        $imagePath = session('temp_image_path');
    
        $wasteDetection = (object)[
            'waste_type' => 'Organic',
            'confidence_score' => 85.5,
            'recycle_info' => 'You can compost organic waste to make fertilizer.',
            'points_earned' => 10,
            'image_path' => $imagePath, // Gunakan image path yang disimpan
            'created_at' => now(),
            'recommendation' => 'You can process this waste into compost for your garden.'
        ];
    
        return view('waste.result', compact('wasteDetection'));
    }
}