<?php

return [
    'api_url' => env('WASTE_DETECTION_API_URL', 'http://your-ml-model-api.com/detect'),
    'api_key' => env('WASTE_DETECTION_API_KEY'),
    
    'points' => [
        'plastic' => 10,
        'paper' => 8,
        'glass' => 12,
        'metal' => 15,
        'organic' => 5,
        'default' => 5,
    ],
    
    'storage' => [
        'detection_images' => 'waste-images',
        'temp_path' => 'temp/waste-detection',
    ],
];
