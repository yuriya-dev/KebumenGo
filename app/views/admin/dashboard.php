<?php
$pageTitle = 'Dashboard';
$widgets = [
    ['label' => 'Total Destinasi', 'value' => '32', 'note' => '28 aktif'],
    ['label' => 'Kategori Aktif', 'value' => '6', 'note' => '2 unggulan'],
    ['label' => 'Ulasan Pending', 'value' => '14', 'note' => 'Butuh moderasi'],
    ['label' => 'Pencarian Populer', 'value' => 'Pantai', 'note' => '42% dari pencarian'],
];

$activities = [
    ['title' => 'Pantai Logending', 'detail' => 'Ulasan baru dari Rina', 'time' => '5 menit lalu'],
    ['title' => 'Goa Jatijajar', 'detail' => 'Destinasi diupdate harga tiket', 'time' => '1 jam lalu'],
    ['title' => 'Sate Ambal', 'detail' => 'Kategori kuliner paling sering dicari', 'time' => 'Hari ini'],
];

ob_start();
?>
<section class="admin-section">
    <div class="admin-grid">
        <?php foreach ($widgets as $widget): ?>
            <div class="admin-card">
                <span class="card-label"><?= htmlspecialchars($widget['label'], ENT_QUOTES, 'UTF-8'); ?></span>
                <strong><?= htmlspecialchars($widget['value'], ENT_QUOTES, 'UTF-8'); ?></strong>
                <p><?= htmlspecialchars($widget['note'], ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="admin-section">
    <div class="admin-two-col">
        <div class="admin-panel">
            <h2>Aktivitas terbaru</h2>
            <ul class="activity-list">
                <?php foreach ($activities as $activity): ?>
                    <li>
                        <div>
                            <strong><?= htmlspecialchars($activity['title'], ENT_QUOTES, 'UTF-8'); ?></strong>
                            <p><?= htmlspecialchars($activity['detail'], ENT_QUOTES, 'UTF-8'); ?></p>
                        </div>
                        <span><?= htmlspecialchars($activity['time'], ENT_QUOTES, 'UTF-8'); ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="admin-panel">
            <h2>Quick actions</h2>
            <div class="quick-actions">
                <a class="btn btn-primary" href="<?= BASE_URL; ?>admin/destinasi/create">Tambah Destinasi</a>
                <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/kategori/create">Tambah Kategori</a>
                <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/ulasan">Moderasi Ulasan</a>
            </div>
            <div class="insight-card">
                <h3>Insight minggu ini</h3>
                <p>Destinasi dengan budget di bawah Rp 75.000 naik 18% pada pencarian.</p>
                <span class="badge badge-accent">Budget Traveler</span>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
