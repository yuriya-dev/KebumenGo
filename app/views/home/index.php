<?php
$pageTitle = 'Beranda';
$categories = [
    ['name' => 'Pantai', 'slug' => 'pantai', 'pill_class' => 'pill-1'],
    ['name' => 'Goa', 'slug' => 'goa', 'pill_class' => 'pill-2'],
    ['name' => 'Sejarah', 'slug' => 'sejarah', 'pill_class' => 'pill-3'],
    ['name' => 'Kuliner', 'slug' => 'kuliner', 'pill_class' => 'pill-4'],
    ['name' => 'Alam', 'slug' => 'alam', 'pill_class' => 'pill-5'],
    ['name' => 'Buatan', 'slug' => 'buatan', 'pill_class' => 'pill-6'],
];

$popularDestinations = [
    ['name' => 'Pantai Logending', 'slug' => 'pantai-logending', 'category' => 'Pantai', 'price' => 25000, 'rating' => 4.8, 'reviews' => 128, 'media_class' => 'media-1', 'badge' => 'Murah'],
    ['name' => 'Goa Jatijajar', 'slug' => 'goa-jatijajar', 'category' => 'Goa', 'price' => 30000, 'rating' => 4.7, 'reviews' => 92, 'media_class' => 'media-2', 'badge' => 'Populer'],
    ['name' => 'Benteng Van der Wijck', 'slug' => 'benteng-van-der-wijck', 'category' => 'Sejarah', 'price' => 20000, 'rating' => 4.6, 'reviews' => 64, 'media_class' => 'media-3'],
    ['name' => 'Pantai Karang Bolong', 'slug' => 'pantai-karang-bolong', 'category' => 'Pantai', 'price' => 25000, 'rating' => 4.5, 'reviews' => 83, 'media_class' => 'media-4'],
    ['name' => 'Sate Ambal', 'slug' => 'sate-ambal', 'category' => 'Kuliner', 'price' => 35000, 'rating' => 4.9, 'reviews' => 210, 'media_class' => 'media-5', 'badge' => 'Favorit'],
    ['name' => 'Bukit Pentulu Indah', 'slug' => 'bukit-pentulu-indah', 'category' => 'Alam', 'price' => 15000, 'rating' => 4.4, 'reviews' => 55, 'media_class' => 'media-6'],
];

$testimonials = [
    ['name' => 'Reza', 'role' => 'Backpacker', 'comment' => 'Budgetku pas banget. Rekomendasinya akurat dan gampang dipakai.', 'rating' => 4.8],
    ['name' => 'Budi', 'role' => 'Kepala Keluarga', 'comment' => 'Bisa hitung biaya untuk 4 orang dengan cepat. Hemat waktu.', 'rating' => 4.7],
    ['name' => 'Citra', 'role' => 'Road Tripper', 'comment' => 'Cocok buat mampir singkat. Destinasinya jelas dan rapi.', 'rating' => 4.6],
];

ob_start();
?>
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow">Wisata cerdas, budget tepat</span>
            <h1>Rencanakan wisata Kebumen sesuai budget, tanpa ribet.</h1>
            <p>KebumenGo membantu kamu memilih destinasi terbaik berdasarkan biaya tiket, makan, dan parkir. Semua transparan sebelum berangkat.</p>
            <?php include __DIR__ . '/../partials/hero-search.php'; ?>
            <div class="hero-stats">
                <div>
                    <strong>30+</strong>
                    <span>Destinasi terkurasi</span>
                </div>
                <div>
                    <strong>2 menit</strong>
                    <span>Rata-rata waktu rencana</span>
                </div>
                <div>
                    <strong>4.8/5</strong>
                    <span>Rating kepuasan</span>
                </div>
            </div>
        </div>
        <div class="hero-collage" aria-hidden="true">
            <div class="hero-tile tile-1">Pantai Selatan</div>
            <div class="hero-tile tile-2">Goa Eksotis</div>
            <div class="hero-tile tile-3">Kuliner Lokal</div>
            <div class="hero-tile tile-4">Sunrise Hills</div>
        </div>
    </div>
</section>

<section class="section" id="kategori">
    <div class="container">
        <div class="section-head">
            <h2>Jelajahi berdasarkan kategori</h2>
            <p>Pilih gaya liburan yang kamu inginkan. Pantai, goa, kuliner, semua ada di sini.</p>
        </div>
        <div class="category-grid">
            <?php foreach ($categories as $category): ?>
                <?php include __DIR__ . '/../partials/category-pill.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section surface">
    <div class="container">
        <div class="section-head">
            <h2>Destinasi populer minggu ini</h2>
            <p>Rekomendasi paling sering dipilih wisatawan dengan budget hemat.</p>
        </div>
        <div class="destination-grid">
            <?php foreach ($popularDestinations as $destination): ?>
                <?php include __DIR__ . '/../partials/destination-card.php'; ?>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="section promo" id="tentang">
    <div class="container promo-grid">
        <div class="promo-copy">
            <span class="eyebrow">Kenapa KebumenGo</span>
            <h2>Semua biaya transparan sejak awal.</h2>
            <p>Kami menggabungkan tiket masuk, makan, dan parkir untuk setiap destinasi. Jadi kamu bisa fokus menikmati perjalanan.</p>
            <div class="promo-features">
                <div class="promo-card">
                    <h3>Wisata gratis</h3>
                    <p>Temukan spot tanpa tiket masuk dan hemat lebih banyak.</p>
                </div>
                <div class="promo-card">
                    <h3>Kuliner murah</h3>
                    <p>Rekomendasi makanan lokal dengan harga bersahabat.</p>
                </div>
            </div>
        </div>
        <div class="promo-visual">
            <div>
                <span class="label">Budget Planner</span>
                <strong>Mulai dari Rp 50.000</strong>
            </div>
            <div>
                <span class="label">Rute Cepat</span>
                <strong>Half day trip</strong>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="section-head">
            <h2>Ulasan pengunjung</h2>
            <p>Cerita singkat dari wisatawan yang sudah mencoba KebumenGo.</p>
        </div>
        <div class="testimonial-track">
            <?php foreach ($testimonials as $testimonial): ?>
                <article class="testimonial-card">
                    <div class="testimonial-header">
                        <div>
                            <h4><?= htmlspecialchars($testimonial['name'], ENT_QUOTES, 'UTF-8'); ?></h4>
                            <span><?= htmlspecialchars($testimonial['role'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </div>
                        <span class="rating-badge"><?= number_format($testimonial['rating'], 1); ?>/5</span>
                    </div>
                    <p><?= htmlspecialchars($testimonial['comment'], ENT_QUOTES, 'UTF-8'); ?></p>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
