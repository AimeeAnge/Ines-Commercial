// assets/js/app.js - INES PRO Frontend Logic

// Cart badge update
function updateCartBadge(count) {
    const badges = document.querySelectorAll('.cart-count');
    badges.forEach(b => {
        b.textContent = count;
        b.style.display = count > 0 ? 'flex' : 'none';
    });
}

// Toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.style.background = type === 'success' ? '#102212' : '#ef4444';
    toast.textContent = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 100);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function () {
    const alerts = document.querySelectorAll('.alert-auto-dismiss');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => alert.remove(), 300);
        }, 4000);
    });
});

// Confirm delete action
function confirmDelete(message) {
    return confirm(message || 'Are you sure you want to delete this item?');
}

// Image preview on file select
document.addEventListener('DOMContentLoaded', function () {
    const fileInputs = document.querySelectorAll('input[type="file"][data-preview]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function () {
            const previewId = this.getAttribute('data-preview');
            const preview = document.getElementById(previewId);
            if (preview && this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
});

// Cart quantity update (optimistic UI)
document.addEventListener('DOMContentLoaded', function () {
    const addToCartForms = document.querySelectorAll('form[data-cart-form]');
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function () {
            showToast('✓ Item added to cart!');
        });
    });
});

// Auto-refresh for admin dashboard (every 30 seconds)
if (document.body.dataset.adminDashboard) {
    setInterval(() => {
        // Silently refresh pending count badges via fetch (minimal polling)
        fetch('?json=counts')
            .then(r => r.ok ? r.json() : null)
            .then(data => {
                if (data) {
                    document.querySelectorAll('[data-count="orders"]').forEach(el => el.textContent = data.orders);
                    document.querySelectorAll('[data-count="messages"]').forEach(el => el.textContent = data.messages);
                }
            })
            .catch(() => { }); // Silently fail
    }, 30000);
}
