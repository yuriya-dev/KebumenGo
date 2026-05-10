<?php
$category = $category ?? [];
$name = $category['name'] ?? 'Pantai';
$slug = $category['slug'] ?? 'pantai';
$pillClass = $category['pill_class'] ?? 'pill-1';
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
?>
<a class="category-pill <?= htmlspecialchars($pillClass, ENT_QUOTES, 'UTF-8'); ?>" href="<?= $baseUrl; ?>destinasi?kategori=<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>">
    <span class="pill-label"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></span>
</a>
