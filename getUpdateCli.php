#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

$API_KEY = '368211924:AAHAU2YbGaYtEA9Vi_rr4usdp6nFXufs2z4';
$BOT_NAME = 'botChanque';
$mysql_credentials = [
   'host'     => 'localhost',
   'user'     => 'root',
   'password' => '12345678a',
   'database' => 'botChanque',
];

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($API_KEY, $BOT_NAME);

    // Enable MySQL
    $telegram->enableMySQL($mysql_credentials);

    // Handle telegram getUpdate request
    $telegram->handleGetUpdates();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
    echo $e;
}
