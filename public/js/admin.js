(() => {
    const toggle = document.querySelector('[data-admin-toggle]');
    const sidebar = document.querySelector('[data-admin-sidebar]');

    if (toggle && sidebar) {
        toggle.addEventListener('click', () => {
            sidebar.classList.toggle('is-open');
        });
    }
})();
