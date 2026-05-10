<?php
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$title = isset($pageTitle) ? $pageTitle . ' | Admin - ' . APP_NAME : 'Admin - ' . APP_NAME;
$adminName = $_SESSION['admin_name'] ?? 'Admin';
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
<body class="admin-body">
    <div class="admin-shell">
        <aside class="admin-sidebar" data-admin-sidebar>
            <div class="sidebar-brand">
                <img src="<?= $baseUrl; ?>public/images/logo.svg" alt="KebumenGo logo">
                <span>KebumenGo</span>
            </div>
            <nav class="sidebar-nav">
                <a href="<?= $baseUrl; ?>admin/dashboard" class="nav-item">Dashboard</a>
                <a href="<?= $baseUrl; ?>admin/destinasi" class="nav-item">Destinasi</a>
                <a href="<?= $baseUrl; ?>admin/kategori" class="nav-item">Kategori</a>
                <a href="<?= $baseUrl; ?>admin/ulasan" class="nav-item">Ulasan</a>
            </nav>
            <div class="sidebar-footer">
                <span><?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?></span>
                <a class="btn btn-outline" href="<?= $baseUrl; ?>admin/logout">Keluar</a>
            </div>
        </aside>
        <div class="admin-main">
            <header class="admin-topbar">
                <button class="menu-toggle" type="button" data-admin-toggle>
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div>
                    <h1><?= htmlspecialchars($pageTitle ?? 'Dashboard', ENT_QUOTES, 'UTF-8'); ?></h1>
                    <p>Kelola konten pariwisata Kebumen secara cepat dan rapi.</p>
                </div>
                <div class="admin-user">
                    <div class="user-avatar">A</div>
                    <div>
                        <strong><?= htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?></strong>
                        <span>Admin</span>
                    </div>
                </div>
            </header>
            <div class="admin-content">
                <?php require __DIR__ . '/../partials/admin-flash.php'; ?>
                <?= $content ?? ''; ?>
            </div>
        </div>
    </div>
    <script src="<?= $baseUrl; ?>public/js/admin.js" defer></script>
</body>
</html>
