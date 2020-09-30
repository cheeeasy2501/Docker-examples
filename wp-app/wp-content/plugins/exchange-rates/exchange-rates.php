<?php
/*
 * Plugin name: Exchange Rates
 * Description: Exchange Rates plugin
 * Author: Nikita Koido
 * Version: 0.1
 * */

require __DIR__. '/functions.php';

add_action('wp_enqueue_scripts', 'exchange_rates_scripts'); // подключение файлов

