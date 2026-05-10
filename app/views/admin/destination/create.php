<?php
$pageTitle = 'Tambah Destinasi';
ob_start();
?>
<section class="admin-section">
    <form class="admin-form" method="post" action="<?= BASE_URL; ?>admin/destinasi/create" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
        <div class="form-grid">
            <label>
                Nama Destinasi
                <input type="text" name="name" required placeholder="Pantai Logending">
            </label>
            <label>
                Kategori
                <select name="category" required>
                    <option value="pantai">Pantai</option>
                    <option value="goa">Goa</option>
                    <option value="sejarah">Sejarah</option>
                    <option value="kuliner">Kuliner</option>
                </select>
            </label>
            <label>
                Harga Tiket (Rp)
                <input type="number" name="ticket_price" min="0" value="25000">
            </label>
            <label>
                Estimasi Makan (Rp)
                <input type="number" name="est_food" min="0" value="20000">
            </label>
            <label>
                Estimasi Parkir (Rp)
                <input type="number" name="est_parking" min="0" value="10000">
            </label>
            <label>
                Jam Operasional
                <input type="text" name="operational_day" value="Senin - Minggu">
            </label>
            <label>
                Jam Buka
                <input type="time" name="open_time" value="07:00">
            </label>
            <label>
                Jam Tutup
                <input type="time" name="close_time" value="17:00">
            </label>
        </div>
        <label>
            Deskripsi
            <textarea name="description" rows="4" placeholder="Tuliskan deskripsi singkat"></textarea>
        </label>
        <label>
            Foto Utama
            <input type="file" name="main_photo">
        </label>
        <label>
            Fasilitas (pisahkan dengan koma)
            <input type="text" name="facilities" placeholder="Toilet, Mushola, Parkir">
        </label>
        <label>
            Embed Maps
            <textarea name="maps_embed" rows="3" placeholder="URL embed Google Maps"></textarea>
        </label>
        <div class="form-actions">
            <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/destinasi">Batal</a>
            <button class="btn btn-primary" type="submit">Simpan Destinasi</button>
        </div>
    </form>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
