// resources/views/waste/detect.blade.php

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div id="uploadSection" class="bg-white rounded-lg shadow p-6">
        <form id="uploadForm" action="{{ route('waste.process') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <!-- Dropzone -->
                <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-green-500 transition-colors">
                    <input type="file" name="image" id="imageInput" class="hidden" accept="image/*">
                    <div class="space-y-2">
                        <i class='bx bx-upload text-4xl text-gray-400'></i>
                        <p class="text-gray-600">Drag and drop an image or click to browse</p>
                    </div>
                </div>

                <!-- Preview -->
                <div id="imagePreview" class="hidden">
                    <img src="" alt="Preview" class="max-h-64 mx-auto rounded-lg">
                    <button type="button" id="removeImage" class="mt-2 text-red-600 hover:text-red-700">
                        Remove image
                    </button>
                </div>

                <!-- Loading -->
                <div id="loadingIndicator" class="hidden text-center">
                    <div class="animate-spin rounded-full h-10 w-10 border-b-2 border-green-500 mx-auto"></div>
                    <p class="mt-2 text-gray-600">Processing image...</p>
                </div>

                <!-- Error Message -->
                @if(session('error'))
                <div class="bg-red-50 text-red-600 p-4 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                        Detect Waste
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('uploadForm');
    const dropzone = document.getElementById('dropzone');
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = imagePreview.querySelector('img');
    const removeButton = document.getElementById('removeImage');
    const loadingIndicator = document.getElementById('loadingIndicator');

    // Drag and drop handlers
    dropzone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropzone.classList.add('border-green-500');
    });

    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('border-green-500');
    });

    dropzone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropzone.classList.remove('border-green-500');
        
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            handleImageSelect(file);
        }
    });

    // Click to upload
    dropzone.addEventListener('click', () => {
        imageInput.click();
    });

    imageInput.addEventListener('change', (e) => {
        if (e.target.files.length) {
            handleImageSelect(e.target.files[0]);
        }
    });

    // Remove image
    removeButton.addEventListener('click', () => {
        imageInput.value = '';
        imagePreview.classList.add('hidden');
        dropzone.classList.remove('hidden');
    });

    // Form submit
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        
        if (!imageInput.files.length) {
            alert('Please select an image first');
            return;
        }

        try {
            loadingIndicator.classList.remove('hidden');
            dropzone.classList.add('hidden');
            imagePreview.classList.add('hidden');

            const formData = new FormData(form);
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });

            if (!response.ok) throw new Error('Upload failed');

            const result = await response.json();
            window.location.href = result.redirect;

        } catch (error) {
            alert('Failed to process image. Please try again.');
            console.error(error);
        } finally {
            loadingIndicator.classList.add('hidden');
            imagePreview.classList.remove('hidden');
        }
    });

    function handleImageSelect(file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            previewImg.src = e.target.result;
            dropzone.classList.add('hidden');
            imagePreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection