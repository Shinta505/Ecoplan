<!-- resources/views/profile.blade.php -->
@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-gray-100">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="relative mb-8">
            <div class="absolute inset-0 bg-gradient-to-r from-green-400 to-emerald-600 rounded-lg opacity-10"></div>
            <div class="relative px-6 py-8 md:py-10 rounded-lg">
                <h1 class="text-3xl font-bold text-gray-900">Profile Settings</h1>
                <p class="mt-2 text-lg text-gray-600">Manage your account settings and preferences</p>
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mb-8 rounded-md bg-green-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 rounded-md bg-red-50 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Main Form -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <!-- Profile Photo Section -->
                <div class="bg-gradient-to-r from-green-50 to-emerald-50 px-6 py-8 border-b border-gray-200">
                    <div class="max-w-4xl mx-auto">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Profile Photo</h2>
                        <div class="flex items-center gap-x-8">
                            <div class="relative">
                                <img src="{{ auth()->user()->profile_image 
                                    ? Storage::url(auth()->user()->profile_image) 
                                    : asset('images/default-avatar.png') }}"
                                    alt="Profile photo"
                                    class="h-32 w-32 rounded-full object-cover ring-4 ring-white shadow-md"
                                    id="profile-image-preview">
                                <div class="absolute bottom-0 right-0 rounded-full bg-white p-1.5 shadow-lg">
                                    <label for="profile_image" class="cursor-pointer">
                                        <svg class="w-5 h-5 text-gray-600 hover:text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <input type="file" id="profile_image" name="profile_image" class="hidden" accept="image/*">
                                    </label>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <button type="button" 
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        onclick="document.getElementById('profile_image').click()">
                                    Change photo
                                </button>
                                @if(auth()->user()->profile_image)
                                    <button type="button"
                                            onclick="event.preventDefault(); document.getElementById('delete-photo-form').submit();"
                                            class="block text-sm font-medium text-red-600 hover:text-red-500">
                                        Remove photo
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Basic Information Section -->
                <div class="px-6 py-8 border-b border-gray-200">
                    <div class="max-w-4xl mx-auto">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Basic Information</h2>
                        <div class="grid grid-cols-1 gap-y-6 gap-x-8 sm:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <div class="mt-1">
                                    <input type="text" 
                                           name="name" 
                                           id="name" 
                                           value="{{ auth()->user()->name }}"
                                           class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input type="tel" 
                                           name="phone" 
                                           id="phone" 
                                           value="{{ auth()->user()->phone }}"
                                           class="shadow-sm focus:ring-green-500 focus:border-green-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                </div>
                                @error('phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="sm:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                <div class="mt-1">
                                    <input type="email" 
                                           name="email" 
                                           id="email" 
                                           value="{{ auth()->user()->email }}"
                                           disabled
                                           class="shadow-sm block w-full sm:text-sm border-gray-300 rounded-md bg-gray-50">
                                    <p class="mt-2 text-sm text-gray-500">Email cannot be changed</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Password Section -->
                <div class="px-6 py-8 bg-gray-50">
                    <div class="max-w-4xl mx-auto">
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Change Password</h2>
                        <p class="text-sm text-gray-500 mb-6">Leave blank if you don't want to change the password</p>
                        
                        <div class="space-y-6">
                            <div class="max-w-md">
                                <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="password" 
                                           name="current_password" 
                                           id="current_password" 
                                           class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" onclick="togglePassword('current_password')" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="max-w-md">
                                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="password" 
                                           name="new_password" 
                                           id="new_password" 
                                           class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" onclick="togglePassword('new_password')" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                @error('new_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="max-w-md">
                                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <input type="password" 
                                           name="new_password_confirmation" 
                                           id="new_password_confirmation" 
                                           class="focus:ring-green-500 focus:border-green-500 block w-full pr-10 sm:text-sm border-gray-300 rounded-md">
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" onclick="togglePassword('new_password_confirmation')" class="text-gray-400 hover:text-gray-500">
                                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="reset"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Reset Changes
                    </button>
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>

        <!-- Hidden form for photo deletion -->
        <form id="delete-photo-form" action="{{ route('profile.delete-image') }}" method="POST" class="hidden">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileInput = document.getElementById('profile_image');
    const preview = document.getElementById('profile-image-preview');
    const maxSize = 2 * 1024 * 1024; // 2MB

    profileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        
        // Validate file size
        if (file.size > maxSize) {
            alert('File is too large. Maximum size is 2MB.');
            this.value = '';
            return;
        }

        // Validate file type
        if (!file.type.match('image.*')) {
            alert('Please select an image file.');
            this.value = '';
            return;
        }

        // Preview image
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.add('animate-pulse');
            setTimeout(() => {
                preview.classList.remove('animate-pulse');
            }, 1000);
        }
        reader.readAsDataURL(file);
    });
});

// Improved password toggle function
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling.querySelector('button');
    const icon = button.querySelector('svg');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
    } else {
        input.type = 'password';
        icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />`;
    }
}
</script>
@endpush
@endsection