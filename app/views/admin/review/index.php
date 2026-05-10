<?php
$pageTitle = 'Moderasi Ulasan';
$reviews = [
    ['id' => 1, 'name' => 'Rina', 'destination' => 'Pantai Logending', 'rating' => 5, 'status' => 'pending'],
    ['id' => 2, 'name' => 'Yoga', 'destination' => 'Pantai Logending', 'rating' => 4, 'status' => 'approved'],
    ['id' => 3, 'name' => 'Sari', 'destination' => 'Goa Jatijajar', 'rating' => 5, 'status' => 'pending'],
];

ob_start();
?>
<section class="admin-section">
    <div class="admin-header">
        <div>
            <h2>Ulasan pengunjung</h2>
            <p>Setujui atau tolak ulasan sebelum tampil di website.</p>
        </div>
        <form method="post" action="<?= BASE_URL; ?>admin/ulasan/aksi">
            <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
            <input type="hidden" name="action" value="approve_all">
            <button class="btn btn-primary" type="submit">Approve Semua Pending</button>
        </form>
    </div>
    <div class="table-card">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Destinasi</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reviews as $review): ?>
                    <tr>
                        <td><?= htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars($review['destination'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?= htmlspecialchars((string)$review['rating'], ENT_QUOTES, 'UTF-8'); ?>/5</td>
                        <td>
                            <span class="status-pill <?= $review['status'] === 'approved' ? 'is-active' : 'is-muted'; ?>">
                                <?= htmlspecialchars($review['status'], ENT_QUOTES, 'UTF-8'); ?>
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <form method="post" action="<?= BASE_URL; ?>admin/ulasan/aksi">
                                    <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                    <input type="hidden" name="action" value="approve">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$review['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button class="btn btn-outline" type="submit">Approve</button>
                                </form>
                                <form method="post" action="<?= BASE_URL; ?>admin/ulasan/aksi">
                                    <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                    <input type="hidden" name="action" value="reject">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars((string)$review['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                    <button class="btn btn-outline" type="submit">Reject</button>
                                </form>
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
