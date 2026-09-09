<?php

/**
 * DEPLOY SCRIPT - YALI Papua
 * 
 * Akses: https://domain-anda.com/deploy.php?token=GANTI_TOKEN_INI
 * 
 * ⚠️  HAPUS FILE INI SETELAH DEPLOY SELESAI!
 */

define('DEPLOY_TOKEN', 'GANTI_TOKEN_INI'); // <-- ganti dengan token rahasia Anda

// Verifikasi token
if (!isset($_GET['token']) || $_GET['token'] !== DEPLOY_TOKEN) {
    http_response_code(403);
    die('<h2 style="color:red">403 Forbidden - Token tidak valid.</h2>');
}

// Bootstrap Laravel
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Helper: jalankan artisan command
function runArtisan($kernel, string $command, array $params = []): string {
    $exitCode = $kernel->call($command, $params);
    $output   = $kernel->output();
    return $output ?: ($exitCode === 0 ? '✓ Berhasil' : '✗ Gagal (exit: ' . $exitCode . ')');
}

$results = [];

// 1. Storage link
$results['storage:link'] = runArtisan($kernel, 'storage:link');

// 2. Migrate
$results['migrate --force'] = runArtisan($kernel, 'migrate', ['--force' => true]);

// 3. Cache konfigurasi
$results['config:cache'] = runArtisan($kernel, 'config:cache');

// 4. Cache route
$results['route:cache'] = runArtisan($kernel, 'route:cache');

// 5. Cache view
$results['view:cache'] = runArtisan($kernel, 'view:cache');

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Deploy - YALI Papua</title>
    <style>
        body { font-family: monospace; background: #1a1a2e; color: #eee; padding: 30px; }
        h1   { color: #00d4aa; }
        .cmd { background: #16213e; border-left: 4px solid #00d4aa; padding: 10px 15px; margin: 10px 0; border-radius: 4px; }
        .cmd strong { color: #f0a500; display: block; margin-bottom: 5px; }
        .cmd pre { margin: 0; white-space: pre-wrap; color: #ccc; }
        .warn { background: #3a1a1a; border-left: 4px solid #ff4444; padding: 12px 15px; margin-top: 20px; border-radius: 4px; color: #ff9999; }
    </style>
</head>
<body>
    <h1>🚀 Deploy - YALI Papua</h1>
    <p>Selesai dijalankan pada: <strong><?= date('Y-m-d H:i:s') ?></strong></p>

    <?php foreach ($results as $cmd => $output): ?>
    <div class="cmd">
        <strong>php artisan <?= htmlspecialchars($cmd) ?></strong>
        <pre><?= htmlspecialchars(trim($output)) ?></pre>
    </div>
    <?php endforeach; ?>

    <div class="warn">
        ⚠️ <strong>PENTING:</strong> Hapus file <code>public/deploy.php</code> via FTP setelah deploy selesai!
    </div>
</body>
</html>
