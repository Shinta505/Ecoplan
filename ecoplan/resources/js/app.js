// Sidebar toggle functionality
const sidebar = document.getElementById('sidebar');
const mainContent = document.querySelector('.main-content');
const toggleBtn = document.getElementById('toggle-btn');

function toggleSidebar() {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('expanded');
    toggleBtn.classList.toggle('rotate');
}

// Mobile sidebar toggle
const mobileToggle = document.createElement('button');
mobileToggle.classList.add('mobile-toggle');
mobileToggle.innerHTML = '<i class="bx bx-menu"></i>';
document.body.appendChild(mobileToggle);

mobileToggle.addEventListener('click', () => {
    sidebar.classList.toggle('show');
});

// Alerts auto-dismiss
document.querySelectorAll('.alert').forEach(alert => {
    setTimeout(() => {
        alert.style.opacity = '0';
        setTimeout(() => alert.remove(), 300);
    }, 5000);
});

// File upload preview
const fileInputs = document.querySelectorAll('input[type="file"]');
fileInputs.forEach(input => {
    input.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            const preview = document.querySelector(this.dataset.preview);
            
            if (preview) {
                reader.onload = e => preview.src = e.target.result;
                reader.readAsDataURL(this.files[0]);
            }
        }
    });
});

// Password toggle visibility
document.querySelectorAll('.password-toggle').forEach(toggle => {
    toggle.addEventListener('click', function() {
        const input = this.previousElementSibling;
        const type = input.type === 'password' ? 'text' : 'password';
        input.type = type;
        this.classList.toggle('ri-eye-fill');
        this.classList.toggle('ri-eye-off-fill');
    });
});
