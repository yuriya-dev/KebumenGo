<?php
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$title = isset($pageTitle) ? $pageTitle . ' | ' . APP_NAME : APP_NAME;
$bodyClass = $bodyClass ?? '';
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="icon" type="image/svg+xml" href="<?= $baseUrl; ?>public/images/logo.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="<?= $baseUrl; ?>public/css/app.css" rel="stylesheet">
</head>
<body class="<?= htmlspecialchars($bodyClass, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="page">
        <?php require __DIR__ . '/../partials/navbar.php'; ?>
        <main class="main-content">
            <?= $content ?? ''; ?>
        </main>
        <?php require __DIR__ . '/../partials/footer.php'; ?>
    </div>
    <script src="<?= $baseUrl; ?>public/js/app.js" defer></script>
    <script src="<?= $baseUrl; ?>public/js/search.js" defer></script>
</body>
</html>
