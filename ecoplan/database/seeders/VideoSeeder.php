<?php

namespace Database\Seeders;

use App\Models\Video;
use Illuminate\Database\Seeder;

class VideoSeeder extends Seeder
{
    public function run()
    {
        $videos = [
            [
                'title' => 'Cara Aman Membuang Baterai Bekas',
                'youtube_id' => 'EqD8iW97p9Q',
                'thumbnail_path' => 'frame-video/1.jpg',
                'description' => 'Fakta Menarik tentang pembuangan baterai bekas',
            ],
            [
                'title' => 'Inovasi Pengolahan Sampah Plastik',
                'youtube_id' => 'qqPRduwuUzs',
                'thumbnail_path' => 'frame-video/2.jpg',
                'description' => '9 INOVASI PENGOLAHAN SAMPAH PLASTIK',
            ],
            // Add more video data
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
