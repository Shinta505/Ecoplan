<!-- resources/views/waste/result.blade.php -->
@extends('layouts.app')

@section('title', 'Detection Result')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Detection Result
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Analysis of your waste image
                </p>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Image Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <div class="aspect-w-16 aspect-h-9">
                    @if($wasteDetection->image_path)
                        <img src="{{ Storage::url($wasteDetection->image_path) }}" 
                            alt="Detected Waste"
                            class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                            <span class="text-gray-400">No image available</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Results Section -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Detection Info -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detection Details</h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Waste Type</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">
                            {{ ucfirst($wasteDetection->waste_type) }}
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Points Earned</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1">
                                <svg class="h-4 w-4 text-green-600 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-lg font-semibold text-green-700">+{{ $wasteDetection->points_earned }} points</span>
                            </span>
                        </dd>
                    </div>

                    @if(isset($wasteDetection->confidence_score))
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Confidence Score</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">
                            {{ number_format($wasteDetection->confidence_score, 1) }}%
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

            <!-- Recommendations -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Handling Recommendations</h3>
                <p class="text-gray-600">{{ $wasteDetection->recommendation }}</p>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="text-center">
                    <p class="text-sm font-medium text-gray-900 mb-4">
                        Keep Supporting Us to Save The Earth!
                    </p>
                    <div class="space-x-4">
                        <a href="{{ route('dashboard') }}" 
                           class="inline-flex items-center rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">
                            Back to Dashboard
                        </a>
                        <a href="{{ route('waste.detect') }}" 
                           class="inline-flex items-center rounded-md bg-white px-3.5 py-2.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                            Detect Another
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection