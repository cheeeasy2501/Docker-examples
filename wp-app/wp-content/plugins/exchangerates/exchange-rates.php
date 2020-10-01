<?php
/*
 * Plugin name: Exchange Rates
 * Description: Exchange Rates plugin
 * Author: Nikita
 * Version: 0.1
 * */

require_once __DIR__ . '/vendor/autoload.php';

use App\Admin\MenusController;
use App\Controllers\ExchangeRatesController;

( new MenusController );

$controller = new ExchangeRatesController();
$controller->initPlugin();
