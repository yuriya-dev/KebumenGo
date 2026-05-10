<?php
$pageTitle = 'Manajemen Destinasi';
$destinations = [
    ['name' => 'Pantai Logending', 'category' => 'Pantai', 'price' => 25000, 'status' => 'aktif', 'updated' => '2026-05-02'],
    ['name' => 'Goa Jatijajar', 'category' => 'Goa', 'price' => 30000, 'status' => 'aktif', 'updated' => '2026-04-28'],
    ['name' => 'Benteng Van der Wijck', 'category' => 'Sejarah', 'price' => 20000, 'status' => 'nonaktif', 'updated' => '2026-04-20'],
    ['name' => 'Sate Ambal', 'category' => 'Kuliner', 'price' => 35000, 'status' => 'aktif', 'updated' => '2026-04-18'],
];

ob_start();
?>
<section class="admin-section">
    <div class="admin-header">
        <div>
            <h2>Daftar destinasi</h2>
            <p>Kelola data destinasi dan tampilkan di halaman utama.</p>
        </div>
        <a class="btn btn-primary" href="<?= BASE_URL; ?>admin/destinasi/create">Tambah Destinasi</a>
    </div>
    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga tiket</th>
                    <th>Status</th>
                    <th>Update</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $destination): ?>
                    <tr>
                        <td><?= htmlspecialchars($destination['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($destination['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= formatRupiah($destination['price']); ?></td>
                        <td>
                            <span class="status-pill <?= $destination['status'] === 'aktif' ? 'is-active' : 'is-muted'; ?>">
                                <?= htmlspecialchars($destination['status'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($destination['updated'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/destinasi/edit">Edit</a>
                                <button class="btn btn-outline" type="button">Arsip</button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
