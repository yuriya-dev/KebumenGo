<?php
$pageTitle = 'Destinasi';
$destinations = [
    ['name' => 'Pantai Logending', 'slug' => 'pantai-logending', 'category' => 'Pantai', 'price' => 25000, 'rating' => 4.8, 'reviews' => 128, 'media_class' => 'media-1', 'badge' => 'Murah'],
    ['name' => 'Pantai Karang Bolong', 'slug' => 'pantai-karang-bolong', 'category' => 'Pantai', 'price' => 25000, 'rating' => 4.5, 'reviews' => 83, 'media_class' => 'media-4'],
    ['name' => 'Goa Jatijajar', 'slug' => 'goa-jatijajar', 'category' => 'Goa', 'price' => 30000, 'rating' => 4.7, 'reviews' => 92, 'media_class' => 'media-2'],
    ['name' => 'Goa Petruk', 'slug' => 'goa-petruk', 'category' => 'Goa', 'price' => 20000, 'rating' => 4.6, 'reviews' => 48, 'media_class' => 'media-5'],
    ['name' => 'Benteng Van der Wijck', 'slug' => 'benteng-van-der-wijck', 'category' => 'Sejarah', 'price' => 20000, 'rating' => 4.6, 'reviews' => 64, 'media_class' => 'media-3'],
    ['name' => 'Sate Ambal', 'slug' => 'sate-ambal', 'category' => 'Kuliner', 'price' => 35000, 'rating' => 4.9, 'reviews' => 210, 'media_class' => 'media-6', 'badge' => 'Favorit'],
    ['name' => 'Bukit Pentulu Indah', 'slug' => 'bukit-pentulu-indah', 'category' => 'Alam', 'price' => 15000, 'rating' => 4.4, 'reviews' => 55, 'media_class' => 'media-1'],
    ['name' => 'Pantai Petanahan', 'slug' => 'pantai-petanahan', 'category' => 'Pantai', 'price' => 20000, 'rating' => 4.3, 'reviews' => 61, 'media_class' => 'media-2'],
];

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
