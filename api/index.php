<?php

define('LARAVEL_START', microtime(true));

// Create writable /tmp directories
foreach ([
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/storage/app',
    '/tmp/bootstrap/cache',
] as $dir) {
    if (!is_dir($dir)) mkdir($dir, 0775, true);
}

require __DIR__ . '/../vendor/autoload.php';

// Override PackageManifest BEFORE app boots
class VercelPackageManifest extends \Illuminate\Foundation\PackageManifest
{
    public function build() { return; }
    public function getManifest() { return []; }
    public function aliases() { return []; }
    public function providers() { return []; }
    protected function write(array $manifest) { return; }
}

$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

// Replace PackageManifest with our Vercel-safe version
$app->singleton(\Illuminate\Foundation\PackageManifest::class, function($app) {
    return new VercelPackageManifest(
        new \Illuminate\Filesystem\Filesystem,
        $app->basePath(),
        '/tmp/bootstrap/cache/packages.php'
    );
});

$app->handleRequest(\Illuminate\Http\Request::capture());