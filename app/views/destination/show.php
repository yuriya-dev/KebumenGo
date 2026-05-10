<?php
$pageTitle = 'Detail Destinasi';
$slug = $viewData['slug'] ?? 'pantai-logending';

$destinations = [
    'pantai-logending' => [
        'name' => 'Pantai Logending',
        'category' => 'Pantai',
        'rating' => 4.8,
        'reviews' => 128,
        'location' => 'Kecamatan Ayah',
        'ticket_price' => 25000,
        'est_food' => 20000,
        'est_parking' => 10000,
        'description' => 'Pantai dengan panorama samudra luas, cocok untuk keluarga dan pecinta sunset.',
        'facilities' => ['Toilet', 'Mushola', 'Parkir', 'Warung'],
        'open' => '07:00',
        'close' => '18:00',
        'days' => 'Senin - Minggu',
        'maps' => 'https://www.google.com/maps?q=pantai+logending&output=embed',
    ],
    'goa-jatijajar' => [
        'name' => 'Goa Jatijajar',
        'category' => 'Goa',
        'rating' => 4.7,
        'reviews' => 92,
        'location' => 'Kecamatan Ayah',
        'ticket_price' => 30000,
        'est_food' => 15000,
        'est_parking' => 8000,
        'description' => 'Goa kapur dengan sejarah menarik dan jalur wisata yang nyaman.',
        'facilities' => ['Toilet', 'Mushola', 'Parkir', 'Pemandu'],
        'open' => '08:00',
        'close' => '17:00',
        'days' => 'Senin - Minggu',
        'maps' => 'https://www.google.com/maps?q=goa+jatijajar&output=embed',
    ],
    'sate-ambal' => [
        'name' => 'Sate Ambal',
        'category' => 'Kuliner',
        'rating' => 4.9,
        'reviews' => 210,
        'location' => 'Kecamatan Ambal',
        'ticket_price' => 0,
        'est_food' => 35000,
        'est_parking' => 5000,
        'description' => 'Sate khas Kebumen dengan bumbu tempe yang gurih dan unik.',
        'facilities' => ['Parkir', 'Mushola', 'Pembayaran Tunai'],
        'open' => '10:00',
        'close' => '22:00',
        'days' => 'Senin - Minggu',
        'maps' => 'https://www.google.com/maps?q=sate+ambal&output=embed',
    ],
];

$destination = $destinations[$slug] ?? $destinations['pantai-logending'];
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';

ob_start();
?>
<section class="section detail-hero">
    <div class="container detail-grid">
        <div class="detail-media">
            <div class="media-stack">
                <div class="media-main"></div>
                <div class="media-thumb media-1"></div>
                <div class="media-thumb media-2"></div>
                <div class="media-thumb media-3"></div>
            </div>
        </div>
        <div class="detail-info">
            <span class="eyebrow"><?= htmlspecialchars($destination['category'], ENT_QUOTES, 'UTF-8'); ?></span>
            <h1><?= htmlspecialchars($destination['name'], ENT_QUOTES, 'UTF-8'); ?></h1>
            <div class="detail-meta">
                <span><?= htmlspecialchars($destination['location'], ENT_QUOTES, 'UTF-8'); ?></span>
                <span class="divider"></span>
                <span><?= number_format($destination['rating'], 1); ?> / 5 (<?= $destination['reviews']; ?>)</span>
            </div>
            <p><?= htmlspecialchars($destination['description'], ENT_QUOTES, 'UTF-8'); ?></p>
            <div class="price-breakdown">
                <div><span>Tiket Masuk</span><strong><?= formatRupiah($destination['ticket_price']); ?> / orang</strong></div>
                <div><span>Estimasi Makan</span><strong><?= formatRupiah($destination['est_food']); ?> / orang</strong></div>
                <div><span>Estimasi Parkir</span><strong><?= formatRupiah($destination['est_parking']); ?> / kendaraan</strong></div>
                <div class="total"><span>Total per Orang</span><strong><?= formatRupiah($destination['ticket_price'] + $destination['est_food']); ?></strong></div>
            </div>
            <div class="detail-actions">
                <a class="btn btn-primary" href="<?= $baseUrl; ?>rekomendasi">Hitung Budget</a>
                <a class="btn btn-outline" href="<?= $baseUrl; ?>destinasi">Lihat Destinasi Lain</a>
            </div>
        </div>
    </div>
</section>

<section class="section surface">
    <div class="container info-grid">
        <div class="info-card">
            <h3>Fasilitas</h3>
            <ul class="pill-list">
                <?php foreach ($destination['facilities'] as $facility): ?>
                    <li><?= htmlspecialchars($facility, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="info-card">
            <h3>Jam Operasional</h3>
            <p><?= htmlspecialchars($destination['days'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><?= htmlspecialchars($destination['open'], ENT_QUOTES, 'UTF-8'); ?> - <?= htmlspecialchars($destination['close'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>
        <div class="info-card">
            <h3>Lokasi</h3>
            <div class="map-embed">
                <iframe src="<?= htmlspecialchars($destination['maps'], ENT_QUOTES, 'UTF-8'); ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Peta <?= htmlspecialchars($destination['name'], ENT_QUOTES, 'UTF-8'); ?>"></iframe>
            </div>
        </div>
    </div>
</section>

<section class="section">
    <div class="container review-grid">
        <div class="review-form">
            <h3>Tulis ulasan</h3>
            <form>
                <label>
                    Nama
                    <input type="text" placeholder="Nama kamu" />
                </label>
                <label>
                    Rating
                    <select>
                        <option>5</option>
                        <option>4</option>
                        <option>3</option>
                        <option>2</option>
                        <option>1</option>
                    </select>
                </label>
                <label>
                    Komentar
                    <textarea rows="4" placeholder="Bagikan pengalamanmu"></textarea>
                </label>
                <button class="btn btn-primary" type="button">Kirim Ulasan</button>
            </form>
        </div>
        <div class="review-list">
            <h3>Ulasan terbaru</h3>
            <article class="review-card">
                <div class="review-header">
                    <strong>Rina</strong>
                    <span>5/5</span>
                </div>
                <p>Suasananya bersih, parkir luas, dan spot foto banyak.</p>
            </article>
            <article class="review-card">
                <div class="review-header">
                    <strong>Yoga</strong>
                    <span>4.5/5</span>
                </div>
                <p>Cocok untuk keluarga, hanya saja ramai saat akhir pekan.</p>
            </article>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
