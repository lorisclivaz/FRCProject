<?php

require __DIR__ . '/vendor/autoload.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
    'http://example.com',    // Your store URL
    'consumer_key',          // Your consumer key
    'consumer_secret',       // Your consumer secret
    [
        'wp_api'  => true,   // Enable the WP REST API integration
        'version' => 'wc/v3' // WooCommerce WP REST API version
    ]
);

?>
