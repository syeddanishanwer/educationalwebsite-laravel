<?php

// Set environment variables for Laravel
$_ENV['APP_ENV'] = getenv('APP_ENV') ?: 'production';

// Boot Laravel
require __DIR__ . '/../public/index.php';