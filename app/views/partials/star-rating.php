<?php
$ratingValue = isset($ratingValue) ? (float)$ratingValue : 0.0;
$fullStars = (int)floor($ratingValue);
$maxStars = 5;
?>
<span class="stars" aria-label="Rating <?= number_format($ratingValue, 1); ?> dari 5">
    <?php for ($i = 1; $i <= $maxStars; $i++): ?>
        <svg class="star <?= $i <= $fullStars ? 'is-active' : ''; ?>" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M12 2.5l2.9 5.9 6.5.9-4.7 4.5 1.1 6.5L12 17.8 6.2 20.3l1.1-6.5L2.6 9.3l6.5-.9L12 2.5z" />
        </svg>
    <?php endfor; ?>
</span>
