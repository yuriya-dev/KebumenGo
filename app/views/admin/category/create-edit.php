<?php
$pageTitle = ($viewData['mode'] ?? 'create') === 'create' ? 'Tambah Kategori' : 'Edit Kategori';
$mode = $viewData['mode'] ?? 'create';

ob_start();
?>
<section class="admin-section">
    <form class="admin-form" method="post" action="<?= BASE_URL; ?>admin/kategori/create" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
        <div class="form-grid">
            <label>
                Nama Kategori
                <input type="text" name="name" value="<?= $mode === 'create' ? '' : 'Pantai'; ?>" required>
            </label>
            <label>
                Slug
                <input type="text" name="slug" value="<?= $mode === 'create' ? '' : 'pantai'; ?>" required>
            </label>
            <label>
                Urutan Tampil
                <input type="number" name="sort_order" min="0" value="<?= $mode === 'create' ? '1' : '1'; ?>">
            </label>
        </div>
        <label>
            Deskripsi Singkat
            <textarea name="description" rows="3" placeholder="Deskripsi kategori"></textarea>
        </label>
        <label>
            Ikon/Foto Kategori
            <input type="file" name="icon_img">
        </label>
        <div class="form-actions">
            <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/kategori">Batal</a>
            <button class="btn btn-primary" type="submit">Simpan Kategori</button>
        </div>
    </form>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
