(() => {
    const toggle = document.querySelector('[data-nav-toggle]');
    const menu = document.querySelector('[data-nav-menu]');

    if (toggle && menu) {
        toggle.addEventListener('click', () => {
            const isOpen = menu.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        });
    }

    const currentPath = window.location.pathname.replace(/\/$/, '') || '/';
    document.querySelectorAll('[data-nav-link]').forEach((link) => {
        const href = link.getAttribute('href') || '';
        if (href === currentPath) {
            link.classList.add('is-active');
        }
    });

    const revealItems = document.querySelectorAll('[data-reveal]');
    if (revealItems.length) {
        if (!('IntersectionObserver' in window)) {
            revealItems.forEach((item) => item.classList.add('reveal', 'is-visible'));
            return;
        }

        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );

        revealItems.forEach((item) => {
            item.classList.add('reveal');
            observer.observe(item);
        });
    }
})();
