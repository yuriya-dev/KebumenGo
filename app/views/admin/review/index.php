<?php
$baseUrl = defined('BASE_URL') ? BASE_URL : '/';
$currentPath = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');
$isDashboard = $currentPath === 'admin/dashboard';
$isAnalitik = str_starts_with($currentPath, 'admin/analitik');
$isDestinasi = str_starts_with($currentPath, 'admin/destinasi') || str_starts_with($currentPath, 'admin/kategori');
$isUlasan = str_starts_with($currentPath, 'admin/ulasan');
$isPengaturan = str_starts_with($currentPath, 'admin/pengaturan');

function navClass(bool $active, string $extra = ''): string
{
    $base = $active
        ? 'flex items-center gap-3 rounded-[10px] bg-textPrimary px-3 py-2 text-white'
        : 'flex items-center gap-3 rounded-[10px] px-3 py-2 text-textSecondary hover:bg-surface';

    return trim($base . ' ' . $extra);
}

try {
    $db = getDB();
    $stmt = $db->query("
        SELECT r.id, r.name, d.name as destination, r.rating, 
               ucfirst(r.status) as status, DATE_FORMAT(r.created_at, '%d %b %Y') as date, r.comment
        FROM reviews r
        JOIN destinations d ON r.dest_id = d.id
        ORDER BY r.created_at DESC
    ");
    $reviews = $stmt->fetchAll();
    if (empty($reviews)) {
        $reviews = [];
    }
} catch (Exception $e) {
    $reviews = [];
    error_log("DB Error: " . $e->getMessage());
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Moderasi Ulasan | Admin KebumenGo</title>
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
    <div class="flex h-screen overflow-hidden">
        <aside class="fixed left-0 top-0 flex h-screen w-[240px] flex-col border-r border-border bg-white px-5 py-6">
            <div class="flex items-center gap-3">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-primary text-white">KG</div>
                <div>
                    <p class="text-sm font-semibold">KebumenGo</p>
                    <span class="text-xs text-textSecondary">Admin Panel</span>
                </div>
            </div>

            <div class="mt-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-textSecondary">Menu</p>
                <nav class="mt-4 grid gap-2">
                    <a href="<?= $baseUrl; ?>admin/dashboard" class="<?= navClass($isDashboard); ?>" <?= $isDashboard ? 'aria-current="page"' : ''; ?>>
                        <i data-lucide="layout-dashboard" class="h-4 w-4"></i>
                        Dashboard
                    </a>
                    <a href="<?= $baseUrl; ?>admin/analitik" class="<?= navClass($isAnalitik); ?>" <?= $isAnalitik ? 'aria-current="page"' : ''; ?>>
                        <i data-lucide="bar-chart-2" class="h-4 w-4"></i>
                        Analitik
                    </a>
                    <a href="<?= $baseUrl; ?>admin/destinasi" class="<?= navClass($isDestinasi); ?>" <?= $isDestinasi ? 'aria-current="page"' : ''; ?>>
                        <i data-lucide="map-pin" class="h-4 w-4"></i>
                        Destinasi
                    </a>
                    <a href="<?= $baseUrl; ?>admin/ulasan" class="<?= navClass($isUlasan); ?>" <?= $isUlasan ? 'aria-current="page"' : ''; ?>>
                        <i data-lucide="star" class="h-4 w-4"></i>
                        Ulasan
                    </a>
                </nav>
            </div>

            <div class="mt-8">
                <p class="text-xs font-semibold uppercase tracking-widest text-textSecondary">Account</p>
                <nav class="mt-4 grid gap-2">
                    <a href="<?= $baseUrl; ?>admin/pengaturan" class="<?= navClass($isPengaturan); ?>" <?= $isPengaturan ? 'aria-current="page"' : ''; ?>>
                        <i data-lucide="settings" class="h-4 w-4"></i>
                        Pengaturan
                    </a>
                </nav>
            </div>
        </aside>

        <main class="ml-[240px] flex h-screen w-full flex-col overflow-y-auto">
            <header class="flex items-center justify-between border-b border-border bg-white px-8 py-4">
                <div>
                    <h1 class="text-2xl font-semibold">Moderasi Ulasan</h1>
                    <p class="text-sm text-textSecondary">Setujui ulasan sebelum tampil di website.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="relative hidden w-72 md:block">
                        <i data-lucide="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-textSecondary"></i>
                        <input type="text" placeholder="Cari destinasi..." class="w-full rounded-xl border border-border bg-surface py-2.5 pl-10 pr-4 text-sm focus:border-primary focus:outline-none">
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 rounded-full bg-surface"></div>
                        <div class="text-sm">
                            <p class="font-semibold">Admin Kebumen</p>
                            <span class="text-xs text-textSecondary">admin@kebumengo.id</span>
                        </div>
                    </div>
                </div>
            </header>

            <div class="space-y-6 px-8 py-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold">Daftar ulasan</h2>
                        <p class="text-sm text-textSecondary">Kelola reputasi destinasi dengan cepat.</p>
                    </div>
                    <form method="post" action="<?= $baseUrl; ?>admin/ulasan/aksi">
                        <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                        <input type="hidden" name="action" value="approve_all">
                        <button class="rounded-lg bg-textPrimary px-4 py-2 text-sm font-semibold text-white" type="submit">Approve Semua Pending</button>
                    </form>
                </div>

                <div class="overflow-hidden rounded-xl border border-border bg-white">
                    <table class="w-full text-sm">
                        <thead class="bg-surface text-left text-xs uppercase tracking-wider text-textSecondary">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Destinasi</th>
                                <th class="px-4 py-3">Rating</th>
                                <th class="px-4 py-3">Komentar</th>
                                <th class="px-4 py-3">Tanggal</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reviews as $review): ?>
                                <?php
                                $statusKey = strtolower($review['status']);
                                $statusClass = $statusKey === 'approved' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700';
                                ?>
                                <tr class="border-t border-border">
                                    <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3 text-textSecondary"><?= htmlspecialchars($review['destination'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3"><?= htmlspecialchars((string)$review['rating'], ENT_QUOTES, 'UTF-8'); ?>/5</td>
                                    <td class="px-4 py-3 text-sm text-textSecondary truncate max-w-[200px] hover:text-wrap" title="<?= htmlspecialchars($review['comment'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($review['comment'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3 text-textSecondary"><?= htmlspecialchars($review['date'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-lg px-2 py-1 text-xs font-semibold <?= $statusClass; ?>">
                                            <?= htmlspecialchars($review['status'], ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <form method="post" action="<?= $baseUrl; ?>admin/ulasan/aksi">
                                                <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                                <input type="hidden" name="action" value="approve">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$review['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-semibold" type="submit">Approve</button>
                                            </form>
                                            <form method="post" action="<?= $baseUrl; ?>admin/ulasan/aksi">
                                                <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                                <input type="hidden" name="action" value="reject">
                                                <input type="hidden" name="id" value="<?= htmlspecialchars((string)$review['id'], ENT_QUOTES, 'UTF-8'); ?>">
                                                <button class="rounded-lg border border-border px-3 py-1.5 text-xs font-semibold text-textSecondary" type="submit">Reject</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>
</html>
