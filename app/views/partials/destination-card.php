<?php
$destination = $destination ?? [];
$name = $destination['name'] ?? 'Pantai Logending';
$category = $destination['category'] ?? 'Pantai';
$price = (int)($destination['price'] ?? 25000);
$rating = (float)($destination['rating'] ?? 4.8);
$reviews = (int)($destination['reviews'] ?? 120);
$slug = $destination['slug'] ?? 'pantai-logending';
$mediaClass = $destination['media_class'] ?? 'media-1';
$badge = $destination['badge'] ?? null;
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
?>
<article class="destination-card">
    <div class="card-media <?= htmlspecialchars($mediaClass, ENT_QUOTES, 'UTF-8'); ?>">
        <?php if ($badge): ?>
            <span class="badge badge-success"><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8'); ?></span>
        <?php endif; ?>
    </div>
    <div class="card-body">
        <div class="card-meta">
            <span class="card-category"><?= htmlspecialchars($category, ENT_QUOTES, 'UTF-8'); ?></span>
            <span class="card-rating">
                <?php $ratingValue = $rating; include __DIR__ . '/star-rating.php'; ?>
                <span class="rating-text"><?= number_format($rating, 1); ?> (<?= $reviews; ?>)</span>
            </span>
        </div>
        <h3><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></h3>
        <p class="price"><?= formatRupiah($price); ?> / orang</p>
        <a class="btn btn-outline" href="<?= $baseUrl; ?>destinasi/<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>">Lihat Detail</a>
    </div>
</article>
