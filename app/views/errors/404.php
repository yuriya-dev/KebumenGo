<?php
$pageTitle = 'Halaman tidak ditemukan';
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
ob_start();
?>
<section class="section page-hero">
    <div class="container">
        <span class="eyebrow">404</span>
        <h1>Halaman tidak ditemukan</h1>
        <p>Maaf, halaman yang kamu cari tidak tersedia.</p>
    <a class="btn btn-primary" href="<?= $baseUrl; ?>">Kembali ke Beranda</a>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
