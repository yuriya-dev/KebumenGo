<?php
$pageTitle = 'Edit Destinasi';
ob_start();
?>
<section class="admin-section">
    <form class="admin-form" method="post" action="<?= BASE_URL; ?>admin/destinasi/edit" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
        <div class="form-grid">
            <label>
                Nama Destinasi
                <input type="text" name="name" value="Pantai Logending" required>
            </label>
            <label>
                Kategori
                <select name="category" required>
                    <option value="pantai" selected>Pantai</option>
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
                <input type="time" name="close_time" value="18:00">
            </label>
        </div>
        <label>
            Deskripsi
            <textarea name="description" rows="4">Pantai dengan panorama samudra luas dan area parkir yang nyaman.</textarea>
        </label>
        <label>
            Foto Utama
            <input type="file" name="main_photo">
        </label>
        <label>
            Fasilitas (pisahkan dengan koma)
            <input type="text" name="facilities" value="Toilet, Mushola, Parkir, Warung">
        </label>
        <label>
            Embed Maps
            <textarea name="maps_embed" rows="3">https://www.google.com/maps?q=pantai+logending&output=embed</textarea>
        </label>
        <div class="form-actions">
            <a class="btn btn-outline" href="<?= BASE_URL; ?>admin/destinasi">Batal</a>
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </div>
    </form>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../../layouts/admin.php';
