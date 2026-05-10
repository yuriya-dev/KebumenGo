(() => {
    const inputs = document.querySelectorAll('[data-budget-input]');
    if (!inputs.length) {
        return;
    }

    const formatRupiah = (value) => {
        const numeric = Number.isFinite(value) ? value : 0;
        return `Rp ${numeric.toLocaleString('id-ID')}`;
    };

    const updatePreview = (input) => {
        const preview = document.querySelector('[data-budget-preview]');
        if (!preview) {
            return;
        }
        const value = parseInt(input.value, 10);
        preview.textContent = formatRupiah(Number.isNaN(value) ? 0 : value);
    };

    inputs.forEach((input) => {
        updatePreview(input);
        input.addEventListener('input', () => updatePreview(input));
    });
})();
