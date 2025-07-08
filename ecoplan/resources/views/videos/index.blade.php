<!-- resources/views/videos/index.blade.php -->
@extends('layouts.app')

@section('title', 'Video Gallery')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header with Search -->
    <div class="mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold text-gray-900 sm:text-3xl">Waste Processing Videos</h2>
                <p class="mt-2 text-lg text-gray-600">Learn effective waste management techniques</p>
            </div>
            <div class="mt-4 sm:mt-0">
                <div class="relative rounded-md shadow-sm">
                    <input type="search" 
                           class="block w-full rounded-md border-gray-300 pl-10 focus:border-green-500 focus:ring-green-500 sm:text-sm" 
                           placeholder="Search videos...">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Video Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    <iframe 
                        id="mainVideo"
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        class="w-full h-full"
                        title="Featured Video"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 id="videoTitle" class="text-xl font-semibold text-gray-900">
                            How to Start Composting at Home
                        </h2>
                        <div class="flex items-center space-x-2">
                            <button class="p-2 text-gray-400 hover:text-green-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/>
                                </svg>
                            </button>
                            <button class="p-2 text-gray-400 hover:text-green-500 transition-colors">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center mb-4">
                        <img src="https://ui-avatars.com/api/?name=Eco+Expert" alt="Channel Avatar" class="w-10 h-10 rounded-full">
                        <div class="ml-3">
                            <p class="text-sm font-medium text-gray-900">EcoExpert Channel</p>
                            <p class="text-sm text-gray-500">52K subscribers</p>
                        </div>
                        <button class="ml-auto bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Subscribe
                        </button>
                    </div>
                    <div class="border-t border-gray-100 pt-4">
                        <p id="videoDescription" class="text-gray-600">
                            Learn the step-by-step process of starting your own compost bin at home. This comprehensive guide covers everything from choosing the right container to maintaining the perfect balance of materials.
                        </p>
                        <div class="mt-4 flex items-center space-x-4">
                            <span class="text-sm text-gray-500">15K views</span>
                            <span class="text-sm text-gray-500">2 weeks ago</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video List -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-medium text-gray-900">Related Videos</h3>
                        <select class="text-sm border-gray-300 rounded-md">
                            <option>Most Recent</option>
                            <option>Most Popular</option>
                            <option>Most Relevant</option>
                        </select>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 overflow-y-auto max-h-[600px]">
                    @php
                    $dummyVideos = [
                        [
                            'id' => 'dQw4w9WgXcQ',
                            'title' => 'How to Start Composting at Home',
                            'description' => 'Learn the step-by-step process of starting your own compost bin at home.',
                            'thumbnail' => 'https://picsum.photos/seed/1/320/180',
                            'views' => '15K',
                            'date' => '2 weeks ago'
                        ],
                        [
                            'id' => 'Ux5cQbO_ybw',
                            'title' => 'Recycling Plastic: Best Practices',
                            'description' => 'Discover the proper ways to recycle different types of plastic.',
                            'thumbnail' => 'https://picsum.photos/seed/2/320/180',
                            'views' => '8.5K',
                            'date' => '5 days ago'
                        ],
                        [
                            'id' => 'jNQXAC9IVRw',
                            'title' => 'Zero Waste Living Tips',
                            'description' => 'Simple tips to reduce waste in your daily life.',
                            'thumbnail' => 'https://picsum.photos/seed/3/320/180',
                            'views' => '12K',
                            'date' => '1 week ago'
                        ],
                        [
                            'id' => 'Y7dpJ0oseIA',
                            'title' => 'DIY Eco-Friendly Products',
                            'description' => 'Make your own environmentally friendly household products.',
                            'thumbnail' => 'https://picsum.photos/seed/4/320/180',
                            'views' => '9.2K',
                            'date' => '3 days ago'
                        ],
                        [
                            'id' => 'M7lc1UVf-VE',
                            'title' => 'Understanding Waste Categories',
                            'description' => 'Learn how to properly sort different types of waste.',
                            'thumbnail' => 'https://picsum.photos/seed/5/320/180',
                            'views' => '7.8K',
                            'date' => '1 day ago'
                        ]
                    ]
                    @endphp

                    @foreach($dummyVideos as $video)
                        <div class="video-item p-4 hover:bg-gray-50 cursor-pointer {{ $loop->first ? 'bg-gray-50' : '' }}"
                             data-id="{{ $video['id'] }}"
                             data-title="{{ $video['title'] }}"
                             data-description="{{ $video['description'] }}">
                            <div class="flex space-x-4">
                                <div class="relative flex-shrink-0 w-32 h-20 rounded-lg overflow-hidden group">
                                    <img src="{{ $video['thumbnail'] }}" 
                                         alt="{{ $video['title'] }}"
                                         class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all">
                                        <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-all transform scale-75 group-hover:scale-100" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M8 5v14l11-7z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="text-sm font-medium text-gray-900 line-clamp-2">{{ $video['title'] }}</h4>
                                    <div class="mt-1 flex items-center text-xs text-gray-500">
                                        <span>{{ $video['views'] }} views</span>
                                        <span class="mx-1">•</span>
                                        <span>{{ $video['date'] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const videoItems = document.querySelectorAll('.video-item');
    const mainVideo = document.getElementById('mainVideo');
    const videoTitle = document.getElementById('videoTitle');
    const videoDescription = document.getElementById('videoDescription');

    videoItems.forEach(item => {
        item.addEventListener('click', function() {
            // Update active state
            videoItems.forEach(v => v.classList.remove('bg-gray-50'));
            this.classList.add('bg-gray-50');

            // Update main video
            const videoId = this.dataset.id;
            mainVideo.src = `https://www.youtube.com/embed/${videoId}`;

            // Update info
            videoTitle.textContent = this.dataset.title;
            videoDescription.textContent = this.dataset.description;

            // Scroll into view on mobile
            if (window.innerWidth < 1024) {
                mainVideo.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
});
</script>
@endpush
@endsection