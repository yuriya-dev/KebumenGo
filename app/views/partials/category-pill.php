<?php
$category = $category ?? [];
$name     = $category['name']       ?? 'Pantai';
$slug     = $category['slug']       ?? 'pantai';
$pillClass = $category['pill_class'] ?? 'pill-1';
$baseUrl  = defined('BASE_URL') ? BASE_URL : '/';

// Cek apakah ada gambar di folder categories (jpg/png)
$imgExtensions = ['jpg', 'jpeg', 'png', 'webp'];
$imgPath = null;
$docRoot = defined('DOC_ROOT') ? DOC_ROOT : $_SERVER['DOCUMENT_ROOT'];
foreach ($imgExtensions as $ext) {
    $filePath = $docRoot . '/public/images/categories/' . $slug . '.' . $ext;
    if (file_exists($filePath)) {
        $imgPath = $baseUrl . 'public/images/categories/' . $slug . '.' . $ext;
        break;
    }
}

$inlineStyle = $imgPath
    ? 'background-image: linear-gradient(to top, rgba(0,0,0,0.65) 0%, rgba(0,0,0,0.2) 60%, transparent 100%), url(\'' . htmlspecialchars($imgPath, ENT_QUOTES, 'UTF-8') . '\'); background-size: cover; background-position: center;'
    : '';
?>
<a class="category-pill <?= $imgPath ? 'pill-has-img' : htmlspecialchars($pillClass, ENT_QUOTES, 'UTF-8'); ?>"
   href="<?= $baseUrl; ?>destinasi?kategori=<?= htmlspecialchars($slug, ENT_QUOTES, 'UTF-8'); ?>"
   style="<?= $inlineStyle; ?>">
    <span class="pill-label"><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?></span>
</a>
