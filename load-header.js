document.addEventListener('DOMContentLoaded', () => {
    fetch('header.html')
        .then(response => response.text())
        .then(html => {
            const container = document.getElementById('header-menu');
            if (container) {
                container.innerHTML = html;
            }
        })
        .catch(err => console.error('Error loading header:', err));
});