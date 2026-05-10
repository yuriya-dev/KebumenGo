<?php
$pageTitle = 'Destinasi';
try {
    $db = getDB();
    $stmt = $db->query("
        SELECT d.*, c.name as category, 
               COALESCE(AVG(r.rating), 0) as rating, 
               COUNT(r.id) as reviews,
               IF(d.ticket_price < 20000, 'Murah', NULL) as badge
        FROM destinations d
        JOIN categories c ON d.category_id = c.id
        LEFT JOIN reviews r ON r.dest_id = d.id AND r.status = 'approved'
        WHERE d.status = 'active'
        GROUP BY d.id
        ORDER BY d.created_at DESC
    ");
    $destinations = $stmt->fetchAll();
    
    // Fallback if DB is completely empty or query fails (though exception will be caught)
    if (empty($destinations)) {
        $destinations = [];
    }
} catch (Exception $e) {
    // If DB fails, fallback to empty array or show error
    $destinations = [];
    error_log("DB Error: " . $e->getMessage());
}

$baseUrl = defined('BASE_URL') ? BASE_URL : '/';

ob_start();
?>
<section class="section page-hero" data-reveal>
    <div class="container">
        <span class="eyebrow">Direktori destinasi</span>
        <h1>Semua destinasi wisata Kebumen</h1>
        <p>Filter cepat, urutkan harga, dan temukan destinasi yang cocok untuk rencana liburanmu.</p>
        <div class="info-strip">
            <span>Tip: mulai dari budget Rp 75.000 untuk 1 orang.</span>
            <a class="btn btn-outline" href="<?= $baseUrl; ?>rekomendasi">Coba hitung budget</a>
        </div>
        <div class="filter-bar">
            <div class="filter-tabs">
                <button class="tab is-active" type="button">Semua</button>
                <button class="tab" type="button">Pantai</button>
                <button class="tab" type="button">Goa</button>
                <button class="tab" type="button">Sejarah</button>
                <button class="tab" type="button">Kuliner</button>
                <button class="tab" type="button">Alam</button>
                <button class="tab" type="button">Buatan</button>
            </div>
            <div class="filter-actions">
                <input type="text" placeholder="Cari nama destinasi" />
                <select>
                    <option>Urutkan: Termurah</option>
                    <option>Urutkan: Rating tertinggi</option>
                </select>
            </div>
        </div>
    </div>
</section>

<section class="section surface" data-reveal>
    <div class="container">
        <div class="destination-grid">
            <?php foreach ($destinations as $destination): ?>
                <?php include __DIR__ . '/../partials/destination-card.php'; ?>
            <?php endforeach; ?>
        </div>
        <div class="pagination">
            <button class="page-btn" type="button">1</button>
            <button class="page-btn" type="button">2</button>
            <button class="page-btn" type="button">3</button>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
