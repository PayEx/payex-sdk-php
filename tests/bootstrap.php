<?php

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
	require_once __DIR__ . '/../vendor/autoload.php';
} else {
    $dir      = new RecursiveDirectoryIterator(__DIR__ . '/../src/PayEx/Api');
    $iterator = new RecursiveIteratorIterator($dir);
    foreach ($iterator as $file) {
        $fileName = $file->getFilename();
        if (preg_match('%\.php$%', $fileName)) {
            require_once($file->getPathname());
        }
    }
}

require_once __DIR__ . '/TestCase.php';

if (getenv('MERCHANT_TOKEN') && getenv('PAYEE_ID')) {
    define('MERCHANT_TOKEN', getenv('MERCHANT_TOKEN'));
    define('PAYEE_ID', getenv('PAYEE_ID'));        
} else {
    // Load config
    if (file_exists(__DIR__ . '/config.local.ini')) {
        $config = parse_ini_file(__DIR__ . '/config.local.ini', true);
    } else {
        $config = parse_ini_file(__DIR__ . '/config.ini', true);
    }

    define('MERCHANT_TOKEN', $config['merchant_token']);
    define('PAYEE_ID', $config['payee_id']);
}
