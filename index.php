<?php
declare(strict_types=1);

session_start();

require __DIR__ . '/app/helpers/functions.php';

define('APP_NAME', 'KebumenGo');
define('BASE_URL', '/');

$adminConfig = require __DIR__ . '/config/admin.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '', '/');
$segments = $path === '' ? [] : explode('/', $path);

$viewData = [];

if ($path === 'admin') {
    redirect('admin/dashboard');
}

if ($path === 'admin/login') {
    if (isAdminLoggedIn()) {
        redirect('admin/dashboard');
    }

    if ($method === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        if (!verifyCsrfToken($token)) {
            setFlash('error', 'Sesi login tidak valid. Silakan coba lagi.');
            redirect('admin/login');
        }

        $email = sanitize($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if ($email === $adminConfig['email'] && password_verify($password, $adminConfig['password_hash'])) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_name'] = $adminConfig['name'];
            $_SESSION['admin_email'] = $adminConfig['email'];
            redirect('admin/dashboard');
        }

        setFlash('error', 'Email atau password salah.');
        redirect('admin/login');
    }

    $view = __DIR__ . '/app/views/admin/login.php';
} elseif ($path === 'admin/logout') {
    $_SESSION = [];
    session_destroy();
    redirect('admin/login');
} elseif (str_starts_with($path, 'admin')) {
    requireAdmin();

    if ($method === 'POST') {
        $token = $_POST['csrf_token'] ?? '';
        $redirectTarget = 'admin/dashboard';
        if (str_starts_with($path, 'admin/ulasan')) {
            $redirectTarget = 'admin/ulasan';
        } elseif (str_starts_with($path, 'admin/kategori')) {
            $redirectTarget = 'admin/kategori';
        } elseif (str_starts_with($path, 'admin/destinasi')) {
            $redirectTarget = 'admin/destinasi';
        }
        if (!verifyCsrfToken($token)) {
            setFlash('error', 'Token tidak valid. Silakan ulangi.');
            redirect($redirectTarget);
        }

        if ($path === 'admin/destinasi/create') {
            setFlash('success', 'Destinasi berhasil disimpan (demo).');
            redirect('admin/destinasi');
        }

        if ($path === 'admin/destinasi/edit') {
            setFlash('success', 'Perubahan destinasi tersimpan (demo).');
            redirect('admin/destinasi');
        }

        if ($path === 'admin/kategori/create') {
            setFlash('success', 'Kategori berhasil disimpan (demo).');
            redirect('admin/kategori');
        }

        if ($path === 'admin/ulasan/aksi') {
            setFlash('success', 'Status ulasan berhasil diperbarui (demo).');
            redirect('admin/ulasan');
        }
    }

    if ($path === 'admin/dashboard') {
        $view = __DIR__ . '/app/views/admin/dashboard.php';
    } elseif ($path === 'admin/destinasi') {
        $view = __DIR__ . '/app/views/admin/destination/index.php';
    } elseif ($path === 'admin/destinasi/create') {
        $view = __DIR__ . '/app/views/admin/destination/create.php';
    } elseif ($path === 'admin/destinasi/edit') {
        $view = __DIR__ . '/app/views/admin/destination/edit.php';
    } elseif ($path === 'admin/kategori') {
        $view = __DIR__ . '/app/views/admin/category/index.php';
    } elseif ($path === 'admin/kategori/create') {
        $view = __DIR__ . '/app/views/admin/category/create-edit.php';
        $viewData['mode'] = 'create';
    } elseif ($path === 'admin/ulasan') {
        $view = __DIR__ . '/app/views/admin/review/index.php';
    } else {
        http_response_code(404);
        $view = __DIR__ . '/app/views/errors/404.php';
    }
} elseif ($path === '') {
    $view = __DIR__ . '/app/views/home/index.php';
} elseif ($path === 'destinasi') {
    $view = __DIR__ . '/app/views/destination/index.php';
} elseif (($segments[0] ?? '') === 'destinasi' && !empty($segments[1])) {
    $view = __DIR__ . '/app/views/destination/show.php';
    $viewData['slug'] = $segments[1];
} elseif ($path === 'rekomendasi') {
    $view = __DIR__ . '/app/views/destination/results.php';
} else {
    http_response_code(404);
    $view = __DIR__ . '/app/views/errors/404.php';
}

require $view;
