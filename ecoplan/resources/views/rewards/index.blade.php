<!-- resources/views/rewards/index.blade.php -->
@extends('layouts.app')

@section('title', 'Rewards')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                    Available Rewards
                </h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">
                    Redeem your points for exciting rewards
                </p>
            </div>
            <!-- Points Display -->
            <div class="mt-4 sm:mt-0">
                <div class="inline-flex items-center rounded-md bg-green-50 px-6 py-4">
                    <div class="text-green-700">
                        <span class="text-sm font-medium">Your Points:</span>
                        <span class="ml-2 text-2xl font-bold">{{ number_format(auth()->user()->points) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="rounded-md bg-green-50 p-4 mb-6">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <!-- Rewards Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($rewards as $reward)
        <div class="relative bg-white rounded-lg shadow-sm ring-1 ring-gray-200 hover:shadow-lg transition-shadow duration-200">
            <!-- Reward Image -->
            <div class="aspect-h-1 aspect-w-1 w-full overflow-hidden rounded-t-lg bg-gray-200">
                <img src="{{ Storage::url($reward->image_path) }}" 
                     alt="{{ $reward->name }}"
                     class="h-full w-full object-cover object-center">
            </div>

            <!-- Reward Content -->
            <div class="p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $reward->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600">{{ $reward->description }}</p>
                </div>

                <div class="mt-6 flex items-center justify-between">
                    <div class="flex items-center text-green-600">
                        <svg class="h-5 w-5 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM8.5 12.75l-3-3a.75.75 0 011.06-1.06l1.97 1.97 3.97-3.97a.75.75 0 011.06 1.06l-5 5a.75.75 0 01-1.06 0z"/>
                        </svg>
                        <span class="font-semibold">{{ number_format($reward->points_required) }} points</span>
                    </div>

                    <form action="{{ route('rewards.redeem', $reward) }}" method="POST" class="flex-shrink-0">
                        @csrf
                        <button type="submit" 
                                @if(auth()->user()->points < $reward->points_required) disabled @endif
                                class="inline-flex items-center rounded-md px-3.5 py-2 text-sm font-semibold shadow-sm
                                       {{ auth()->user()->points >= $reward->points_required 
                                            ? 'bg-green-600 text-white hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600'
                                            : 'bg-gray-100 text-gray-400 cursor-not-allowed' }}">
                            {{ auth()->user()->points >= $reward->points_required ? 'Redeem' : 'Not Enough Points' }}
                        </button>
                    </form>
                </div>

                <!-- Progress Bar -->
                @if(auth()->user()->points < $reward->points_required)
                <div class="mt-4">
                    <div class="relative pt-1">
                        <div class="flex mb-2 items-center justify-between">
                            <div class="text-xs text-gray-600">
                                Progress: {{ number_format(auth()->user()->points) }}/{{ number_format($reward->points_required) }}
                            </div>
                            <div class="text-xs text-gray-600">
                                {{ number_format((auth()->user()->points / $reward->points_required) * 100, 1) }}%
                            </div>
                        </div>
                        <div class="overflow-hidden h-2 text-xs flex rounded bg-gray-100">
                            <div class="bg-green-500 rounded" 
                                 style="width: {{ min(auth()->user()->points / $reward->points_required * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection