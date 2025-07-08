<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Welcome Section -->
    <div class="mb-8">
        <h2 class="text-2xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}!</h2>
        <p class="mt-2 text-gray-600">Let's help save the Earth together</p>
    </div>

    <!-- Stats Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Points -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-green-100 rounded-lg">
                    <svg class="w-6 h-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Points</h3>
                    <p class="text-2xl font-semibold text-gray-900">1,035</p>
                </div>
            </div>
            <a href="{{ route('rewards.index') }}" class="mt-4 inline-flex items-center text-sm text-green-600 hover:text-green-700">
                Redeem points
                <svg class="ml-1 w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <!-- Monthly Activities -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-blue-100 rounded-lg">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Activities This Month</h3>
                    <p class="text-2xl font-semibold text-gray-900">24</p>
                </div>
            </div>
        </div>

        <!-- Total Waste Detected -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-purple-100 rounded-lg">
                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Total Waste Detected</h3>
                    <p class="text-2xl font-semibold text-gray-900">156</p>
                </div>
            </div>
        </div>

        <!-- Achievement Level -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center">
                <div class="p-2 bg-yellow-100 rounded-lg">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-sm font-medium text-gray-500">Achievement Level</h3>
                    <p class="text-2xl font-semibold text-gray-900">Gold</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm mb-8">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-medium text-gray-900">Recent Activity</h3>
        </div>
        <div class="divide-y divide-gray-100">
            @foreach([
                ['type' => 'Organic', 'date' => '2 hours ago', 'points' => 10],
                ['type' => 'Inorganic', 'date' => '5 hours ago', 'points' => 15],
                ['type' => 'Organic', 'date' => '1 day ago', 'points' => 10],
                ['type' => 'Inorganic', 'date' => '2 days ago', 'points' => 15],
                ['type' => 'Organic', 'date' => '3 days ago', 'points' => 10],
            ] as $activity)
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="p-2 rounded-lg {{ $activity['type'] === 'Organic' ? 'bg-green-100' : 'bg-blue-100' }}">
                            <svg class="w-5 h-5 {{ $activity['type'] === 'Organic' ? 'text-green-600' : 'text-blue-600' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-900">Detected {{ $activity['type'] }} Waste</p>
                            <p class="text-sm text-gray-500">{{ $activity['date'] }}</p>
                        </div>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $activity['type'] === 'Organic' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
    +{{ $activity['points'] }} points
</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Related Articles -->
    <div class="bg-white rounded-xl shadow-sm">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-medium text-gray-900">Related Articles</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach([
    [
        'title' => 'How to Properly Recycle Plastic',
        'image' => 'https://via.placeholder.com/300x200',
        'description' => 'Learn the best practices for recycling different types of plastic waste.',
    ],
    [
        'title' => 'Composting 101: A Beginner\'s Guide',
        'image' => 'https://via.placeholder.com/300x200',
        'description' => 'Start your composting journey with this comprehensive guide.',
    ],
    [
        'title' => 'Reducing Household Waste',
        'image' => 'https://via.placeholder.com/300x200',
        'description' => 'Tips and tricks to minimize waste in your daily life.',
    ],
] as $article)                <div class="bg-white rounded-lg overflow-hidden border border-gray-100">
                    <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="text-lg font-medium text-gray-900 mb-2">{{ $article['title'] }}</h4>
                        <p class="text-sm text-gray-500 mb-4">{{ $article['description'] }}</p>
                        <button class="text-green-600 hover:text-green-700 text-sm font-medium">
                            Read more →
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection