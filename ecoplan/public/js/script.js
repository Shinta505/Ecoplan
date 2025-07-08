// script.js - Updated with improved functionality

// Sidebar toggle functionality
const toggleButton = document.getElementById('toggle-btn');
const sidebar = document.getElementById('sidebar');

function toggleSidebar() {
    sidebar.classList.toggle('close');
    toggleButton.classList.toggle('rotate');
}

// Logout functionality
function handleLogout() {
    localStorage.removeItem('user');
    window.location.href = 'index.html';
}

// Add logout event listener to all logout buttons
document.querySelectorAll('a[href="#"][title="Logout"]').forEach(button => {
    button.addEventListener('click', handleLogout);
});

// Profile image handling
const defaultProfileImage = 'data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiPjxjaXJjbGUgY3g9IjEyIiBjeT0iOCIgcj0iNSIvPjxwYXRoIGQ9Ik0zIDE4YzAtMi43OSAyLjk0LTcgOS03czggNC4yMSA4IDciLz48L3N2Zz4=';

function initializeProfile() {
    const profileImg = document.querySelector('.profile-picture img');
    if (profileImg) {
        const savedImage = localStorage.getItem('profileImage');
        profileImg.src = savedImage || defaultProfileImage;
    }
}

function handleProfileImageChange() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    
    input.onchange = (e) => {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                const profileImg = document.querySelector('.profile-picture img');
                profileImg.src = event.target.result;
                localStorage.setItem('profileImage', event.target.result);
            };
            reader.readAsDataURL(file);
        }
    };
    
    input.click();
}

function handleProfileImageDelete() {
    const profileImg = document.querySelector('.profile-picture img');
    profileImg.src = defaultProfileImage;
    localStorage.removeItem('profileImage');
}

// Video gallery functionality
function initializeVideoGallery() {
    const videoList = document.querySelectorAll('.video-list .vid');
    const mainVideo = document.querySelector('.main-video iframe');
    const title = document.querySelector('.main-video .title');

    videoList.forEach(video => {
        video.onclick = () => {
            videoList.forEach(vid => vid.classList.remove('active'));
            video.classList.add('active');
            
            const videoId = video.querySelector('img').getAttribute('data-id');
            mainVideo.src = `https://www.youtube.com/embed/${videoId}`;
            title.innerHTML = video.querySelector('.title').innerHTML;
        };
    });
}

// Points redemption system
class PointsSystem {
    constructor() {
        this.points = parseInt(localStorage.getItem('points')) || 0;
        this.updatePointsDisplay();
    }

    addPoints(amount) {
        this.points += amount;
        localStorage.setItem('points', this.points);
        this.updatePointsDisplay();
    }

    redeemPoints(amount) {
        if (this.points >= amount) {
            this.points -= amount;
            localStorage.setItem('points', this.points);
            this.updatePointsDisplay();
            return true;
        }
        return false;
    }

    updatePointsDisplay() {
        const pointsDisplay = document.querySelector('.points span');
        if (pointsDisplay) {
            pointsDisplay.textContent = this.points.toLocaleString();
        }
    }
}

// Initialize components based on current page
document.addEventListener('DOMContentLoaded', () => {
    // Initialize profile if on profile page
    if (document.querySelector('.profile-picture')) {
        initializeProfile();
        
        document.querySelector('.change-picture').addEventListener('click', handleProfileImageChange);
        document.querySelector('.delete-picture').addEventListener('click', handleProfileImageDelete);
    }

    // Initialize video gallery if on video page
    if (document.querySelector('.video-list')) {
        initializeVideoGallery();
    }

    // Initialize points system if on dashboard
    if (document.querySelector('.points')) {
        new PointsSystem();
    }

    // Add logout functionality to all logout buttons
    document.querySelectorAll('a[href="#"][title="Logout"]').forEach(button => {
        button.addEventListener('click', handleLogout);
    });
});