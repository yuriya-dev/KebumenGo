<?php $baseUrl = defined('BASE_URL') ? BASE_URL : '/'; ?>
<form class="hero-search" action="<?= $baseUrl; ?>rekomendasi" method="get">
    <div class="field">
        <label for="kategori">Kategori</label>
        <select id="kategori" name="kategori">
            <option value="semua">Semua Kategori</option>
            <option value="pantai">Pantai</option>
            <option value="goa">Goa</option>
            <option value="sejarah">Sejarah</option>
            <option value="kuliner">Kuliner</option>
        </select>
    </div>
    <div class="field">
        <label for="orang">Jumlah Orang</label>
        <input id="orang" name="orang" type="number" min="1" value="2" />
    </div>
    <div class="field">
        <label for="budget">Budget (Rp)</label>
        <input id="budget" name="budget" type="number" min="0" value="200000" data-budget-input />
    </div>
    <button class="btn btn-primary" type="submit">Cari Rekomendasi</button>
</form>
<div class="budget-preview">Budget saat ini: <span data-budget-preview>Rp 200.000</span></div>
