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
        SELECT d.id, d.name, c.name as category, d.ticket_price as price, 
               d.status, DATE_FORMAT(d.updated_at, '%d %b %Y') as updated
        FROM destinations d
        JOIN categories c ON d.category_id = c.id
        ORDER BY d.created_at DESC
    ");
    $destinations = $stmt->fetchAll();
    if (empty($destinations)) {
        $destinations = [];
    }
} catch (Exception $e) {
    $destinations = [];
    error_log("DB Error: " . $e->getMessage());
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manajemen Destinasi | Admin KebumenGo</title>
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
                    <h1 class="text-2xl font-semibold">Manajemen Destinasi</h1>
                    <p class="text-sm text-textSecondary">Kelola data destinasi wisata Kebumen secara terstruktur.</p>
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
                        <h2 class="text-lg font-semibold">Daftar destinasi</h2>
                        <p class="text-sm text-textSecondary">Pantau status publikasi dan harga tiket terbaru.</p>
                    </div>
                    <div class="flex flex-wrap items-center gap-3">
                        <a href="<?= $baseUrl; ?>admin/kategori" class="rounded-lg border border-border bg-white px-4 py-2 text-sm font-semibold text-textSecondary">Kelola Kategori</a>
                        <a href="<?= $baseUrl; ?>admin/destinasi/create" class="rounded-lg bg-textPrimary px-4 py-2 text-sm font-semibold text-white">+ Tambah Destinasi</a>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <div class="relative w-full max-w-xs">
                        <i data-lucide="search" class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-textSecondary"></i>
                        <input type="text" placeholder="Cari nama destinasi" class="w-full rounded-xl border border-border bg-white py-2.5 pl-10 pr-4 text-sm focus:border-primary focus:outline-none">
                    </div>
                    <select class="rounded-xl border border-border bg-white px-3 py-2 text-sm">
                        <option>Semua status</option>
                        <option>Aktif</option>
                        <option>Pending</option>
                    </select>
                    <select class="rounded-xl border border-border bg-white px-3 py-2 text-sm">
                        <option>Urutkan: Terbaru</option>
                        <option>Urutkan: Termurah</option>
                        <option>Urutkan: Termahal</option>
                    </select>
                </div>

                <div class="overflow-hidden rounded-xl border border-border bg-white">
                    <table class="w-full text-sm">
                        <thead class="bg-surface text-left text-xs uppercase tracking-wider text-textSecondary">
                            <tr>
                                <th class="px-4 py-3">Nama</th>
                                <th class="px-4 py-3">Kategori</th>
                                <th class="px-4 py-3">Harga tiket</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Update</th>
                                <th class="px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($destinations as $destination): ?>
                                <?php
                                $statusKey = strtolower($destination['status']);
                                $statusClass = 'bg-slate-100 text-slate-600';
                                if ($statusKey === 'aktif') {
                                    $statusClass = 'bg-emerald-100 text-emerald-700';
                                } elseif ($statusKey === 'pending') {
                                    $statusClass = 'bg-amber-100 text-amber-700';
                                }
                                ?>
                                <tr class="border-t border-border">
                                    <td class="px-4 py-3 font-semibold"><?= htmlspecialchars($destination['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3 text-textSecondary"><?= htmlspecialchars($destination['category'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3"><?= formatRupiah($destination['price']); ?></td>
                                    <td class="px-4 py-3">
                                        <span class="rounded-lg px-2 py-1 text-xs font-semibold <?= $statusClass; ?>">
                                            <?= htmlspecialchars($destination['status'], ENT_QUOTES, 'UTF-8'); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-textSecondary"><?= htmlspecialchars($destination['updated'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="<?= $baseUrl; ?>admin/destinasi/edit?id=<?= $destination['id'] ?>" class="rounded-lg border border-border px-3 py-1.5 text-xs font-semibold">Edit</a>
                                            <form action="<?= $baseUrl; ?>admin/destinasi/delete" method="POST" onsubmit="return confirm('Yakin ingin menghapus destinasi ini? Data ulasan terkait juga akan terhapus.');" class="inline">
                                                <input type="hidden" name="csrf_token" value="<?= csrfToken(); ?>">
                                                <input type="hidden" name="id" value="<?= $destination['id'] ?>">
                                                <button type="submit" class="rounded-lg border border-border px-3 py-1.5 text-xs font-semibold text-textSecondary text-red-600 hover:bg-red-50">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="flex flex-wrap items-center justify-between text-sm text-textSecondary">
                    <span>Menampilkan 1-4 dari 48 destinasi</span>
                    <div class="flex items-center gap-2">
                        <button class="rounded-lg border border-border bg-white px-3 py-1">1</button>
                        <button class="rounded-lg border border-border bg-white px-3 py-1">2</button>
                        <button class="rounded-lg border border-border bg-white px-3 py-1">3</button>
                    </div>
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