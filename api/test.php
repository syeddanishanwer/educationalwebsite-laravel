<?php
echo "PHP is working. Version: " . PHP_VERSION . "<br>";

// Test autoloader
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "Vendor autoload found<br>";
    require __DIR__ . '/../vendor/autoload.php';
    echo "Autoloader loaded successfully<br>";
} else {
    echo "ERROR: vendor/autoload.php NOT found<br>";
}

// Test env variables
echo "APP_KEY exists: " . (getenv('APP_KEY') ? 'YES' : 'NO') . "<br>";
echo "APP_ENV: " . getenv('APP_ENV') . "<br>";
echo "DB_HOST exists: " . (getenv('DB_HOST') ? 'YES' : 'NO') . "<br>";