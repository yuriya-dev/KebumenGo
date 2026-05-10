<?php
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$title = isset($pageTitle) ? $pageTitle . ' | Admin - ' . APP_NAME : 'Admin - ' . APP_NAME;
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
    <link href="<?= $baseUrl; ?>public/css/admin.css" rel="stylesheet">
</head>
<body class="admin-body auth-body">
    <div class="auth-shell">
        <?= $content ?? ''; ?>
    </div>
</body>
</html>
