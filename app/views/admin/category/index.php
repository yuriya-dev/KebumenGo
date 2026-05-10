<?php
$pageTitle = 'Manajemen Kategori';
$categories = [
    ['name' => 'Pantai', 'slug' => 'pantai', 'order' => 1, 'status' => 'aktif'],
    ['name' => 'Goa', 'slug' => 'goa', 'order' => 2, 'status' => 'aktif'],
    ['name' => 'Sejarah', 'slug' => 'sejarah', 'order' => 3, 'status' => 'aktif'],
    ['name' => 'Kuliner', 'slug' => 'kuliner', 'order' => 4, 'status' => 'aktif'],
];

ob_start();
?>
<section class="admin-section">
    <div class="admin-header">
        <div>
            <h2>Daftar kategori</h2>
            <p>Atur ikon, deskripsi, dan urutan tampil kategori.</p>
        </div>
        <a class="btn btn-primary" href="<?= BASE_URL; ?>admin/kategori/create">Tambah Kategori</a>
    </div>
    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Slug</th>
                    <th>Urutan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= htmlspecialchars($category['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($category['slug'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars((string)$category['order'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td>
                            <span class="status-pill is-active"><?= htmlspecialchars($category['status'], ENT_QUOTES, 'UTF-8'); ?></span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/kategori/create">Edit</a>
                                <button class="btn btn-outline" type="button">Nonaktifkan</button>
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
