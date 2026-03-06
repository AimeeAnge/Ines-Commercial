// project/script.js
document.addEventListener('DOMContentLoaded', () => {
    console.log('INES PRO Dashboard Loaded');
    
    // Add any client-side interactivity here
    const searchInput = document.querySelector('input[placeholder="Search anything..."]');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            console.log('Searching for:', e.target.value);
        });
    }
});
