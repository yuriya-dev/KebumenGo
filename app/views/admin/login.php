<?php
$pageTitle = 'Login Admin';
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$error = getFlash('error');

ob_start();
?>
<div class="auth-card">
    <div class="auth-brand">
        <img src="<?= $baseUrl; ?>public/images/logo.svg" alt="KebumenGo logo">
        <div>
            <h1>Admin KebumenGo</h1>
            <p>Masuk untuk mengelola destinasi dan ulasan.</p>
        </div>
    </div>
    <?php if ($error): ?>
        <div class="alert alert-error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>
    <form class="auth-form" method="post" action="<?= $baseUrl; ?>admin/login">
        <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
        <label>
            Email
            <input type="email" name="email" required placeholder="admin@kebumengo.id">
        </label>
        <label>
            Password
            <input type="password" name="password" required placeholder="Masukkan password">
        </label>
        <button class="btn btn-primary" type="submit">Masuk</button>
        <p class="auth-hint">Demo: admin@kebumengo.id / kebumen2026</p>
    </form>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/auth.php';
