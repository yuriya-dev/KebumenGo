<?php
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$error = getFlash('error');
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin | KebumenGo</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                        accent: '#F59E0B',
                        surface: '#F8FAFC',
                        textPrimary: '#0F172A',
                        textSecondary: '#64748B',
                        border: '#E2E8F0'
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif']
                    }
                }
            }
        };
    </script>
</head>
<body class="bg-white font-sans text-textPrimary">
    <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-white via-surface to-white px-4">
        <div class="w-full max-w-md rounded-2xl border border-border bg-white p-8 shadow-sm">
            <div class="flex items-center gap-3">
                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-primary text-white">KG</div>
                <div>
                    <h1 class="text-lg font-semibold">Admin KebumenGo</h1>
                    <p class="text-sm text-textSecondary">Masuk untuk mengelola konten.</p>
                </div>
            </div>

            <?php if ($error): ?>
                <div class="mt-6 rounded-xl bg-rose-50 px-4 py-3 text-sm text-rose-600">
                    <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            <?php endif; ?>

            <form class="mt-6 space-y-4" method="post" action="<?= $baseUrl; ?>admin/login">
                <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                <label class="text-sm font-semibold">
                    Email
                    <input type="email" name="email" required placeholder="admin@kebumengo.id" class="mt-2 w-full rounded-xl border border-border px-3 py-2.5 text-sm focus:border-primary focus:outline-none">
                </label>
                <label class="text-sm font-semibold">
                    Password
                    <input type="password" name="password" required placeholder="Masukkan password" class="mt-2 w-full rounded-xl border border-border px-3 py-2.5 text-sm focus:border-primary focus:outline-none">
                </label>
                <button class="w-full rounded-xl bg-textPrimary px-4 py-2.5 text-sm font-semibold text-white" type="submit">Masuk</button>
                <p class="text-center text-xs text-textSecondary">Demo: admin@kebumengo.id / kebumen2026</p>
            </form>
        </div>
    </div>
</body>
</html>