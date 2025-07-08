<!-- views/waste/camera.blade.php -->
@extends('layouts.app')

@section('title', 'Camera Detection')

@section('content')
<div class="camera-container">
    <header>Deteksi Sampah</header>
    
    <div class="camera-view">
        <video autoplay="true" id="video-webcam">
            Browser tidak mendukung webcam
        </video>
    </div>

    <div class="camera-controls">
        <button id="captureBtn">Ambil Gambar</button>
        <canvas id="canvas" style="display:none;"></canvas>
    </div>
</div>
@endsection

@section('additional_js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const video = document.querySelector("#video-webcam");
    const canvas = document.querySelector("#canvas");
    const captureBtn = document.querySelector("#captureBtn");

    // Request camera access
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
        })
        .catch(error => {
            alert("Izinkan menggunakan webcam");
            console.error(error);
        });

    // Capture image
    captureBtn.addEventListener('click', () => {
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert to blob and submit
        canvas.toBlob(blob => {
            const formData = new FormData();
            formData.append('image', blob, 'camera-capture.jpg');
            formData.append('_token', '{{ csrf_token() }}');

            fetch('{{ route("waste.detect") }}', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                window.location.href = data.redirect;
            })
            .catch(error => console.error('Error:', error));
        }, 'image/jpeg');
    });
});
</script>
@endsection
