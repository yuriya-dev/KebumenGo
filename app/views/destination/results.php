<?php
$pageTitle = 'Rekomendasi Budget';
$category = $_GET['kategori'] ?? 'semua';
$people = max(1, (int)($_GET['orang'] ?? 2));
$budget = max(0, (int)($_GET['budget'] ?? 200000));
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';

try {
    $db = getDB();
    $stmt = $db->query("
        SELECT d.*, c.name as category, c.slug as category_slug,
               COALESCE(AVG(r.rating), 0) as rating, 
               COUNT(r.id) as reviews
        FROM destinations d
        JOIN categories c ON d.category_id = c.id
        LEFT JOIN reviews r ON r.dest_id = d.id AND r.status = 'approved'
        WHERE d.status = 'active'
        GROUP BY d.id
    ");
    $destinations = $stmt->fetchAll();
    if (empty($destinations)) {
        $destinations = [];
    }
} catch (Exception $e) {
    $destinations = [];
    error_log("DB Error: " . $e->getMessage());
}

$matches = [];
$closest = null;

foreach ($destinations as $destination) {
    $total = (($destination['ticket_price'] + $destination['est_food']) * $people) + $destination['est_parking'];
    $isCategoryMatch = $category === 'semua' || $destination['category_slug'] === $category;

    if ($isCategoryMatch) {
        if ($closest === null || $total < $closest['total_biaya']) {
            $closest = $destination;
            $closest['total_biaya'] = $total;
        }

        if ($total <= $budget) {
            $destination['total_biaya'] = $total;
            $destination['sisa_budget'] = $budget - $total;
            $matches[] = $destination;
        }
    }
}

usort($matches, function (array $a, array $b): int {
    return $a['total_biaya'] <=> $b['total_biaya'];
});

ob_start();
?>
<section class="section page-hero" data-reveal>
    <div class="container">
        <span class="eyebrow">Hasil rekomendasi</span>
        <h1><?= count($matches); ?> destinasi ditemukan</h1>
        <p>Budget: <strong><?= formatRupiah($budget); ?></strong> untuk <?= $people; ?> orang.</p>
        <div class="result-filter">
            <span>Kategori: <?= htmlspecialchars(ucfirst($category), ENT_QUOTES, 'UTF-8'); ?></span>
            <a class="btn btn-outline" href="<?= $baseUrl; ?>">Ubah pencarian</a>
        </div>
    </div>
</section>

<section class="section surface" data-reveal>
    <div class="container">
        <?php if (count($matches) === 0): ?>
            <div class="empty-state">
                <h3>Budget belum mencukupi.</h3>
                <p>Coba tambah sedikit lagi atau pilih destinasi yang lebih hemat.</p>
                <?php if ($closest): ?>
                    <div class="suggestion-card">
                        <div>
                            <h4><?= htmlspecialchars($closest['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <p>Total minimum: <?= formatRupiah($closest['total_biaya']); ?></p>
                        </div>
                        <a class="btn btn-primary" href="<?= $baseUrl; ?>destinasi/<?= htmlspecialchars($closest['slug'], ENT_QUOTES, 'UTF-8'); ?>">Lihat Detail</a>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="result-grid">
                <?php foreach ($matches as $destination): ?>
                    <article class="result-card">
                        <div class="card-media" style="background-image: url('<?= $baseUrl . htmlspecialchars(str_replace('public/', '', (!empty($destination['main_photo']) ? $destination['main_photo'] : 'images/placeholders/destination-placeholder.svg')), ENT_QUOTES, 'UTF-8'); ?>'); background-size: cover; background-position: center;"></div>
                        <div class="card-body">
                            <div class="card-meta">
                                <span class="card-category"><?= htmlspecialchars($destination['category'], ENT_QUOTES, 'UTF-8'); ?></span>
                                <span class="card-rating">
                                    <?php $ratingValue = $destination['rating']; include __DIR__ . '/../partials/star-rating.php'; ?>
                                    <span class="rating-text"><?= number_format($destination['rating'], 1); ?></span>
                                </span>
                            </div>
                            <h3><?= htmlspecialchars($destination['name'], ENT_QUOTES, 'UTF-8'); ?></h3>
                            <p class="price">Total: <?= formatRupiah($destination['total_biaya']); ?></p>
                            <span class="badge badge-accent">Sisa Budget: <?= formatRupiah($destination['sisa_budget']); ?></span>
                            <a class="btn btn-outline" href="<?= $baseUrl; ?>destinasi/<?= htmlspecialchars($destination['slug'], ENT_QUOTES, 'UTF-8'); ?>">Lihat Detail</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
