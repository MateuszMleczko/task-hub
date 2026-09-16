document.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById('avatar-popup');
    if (!popup) return;

    document.querySelectorAll('[data-avatar-popup-open]').forEach((btn) => {
        btn.addEventListener('click', () => popup.showModal());
    });

    popup.querySelectorAll('[data-avatar-popup-close]').forEach((btn) => {
        btn.addEventListener('click', () => popup.close());
    });

    popup.addEventListener('click', (event) => {
        if (event.target === popup) {
            popup.close();
        }
    });
});
