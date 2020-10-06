<?php
/*
 * Plugin name: Exchange Rates
 * Description: Exchange Rates plugin
 * Author: Nikita
 * Version: 0.1
 * */

require_once __DIR__ . '/vendor/autoload.php';

use App\Controllers\MenusController;
use App\Controllers\ExchangeRatesController;
use App\PluginState as State;

define('PLUGIN_BASE_FILE', __FILE__);

(new State(PLUGIN_BASE_FILE));

//( new MenusController );
$menusController = new MenusController();
$menusController->addMenus();

$exchangeRatesController = new ExchangeRatesController();
$exchangeRatesController->initPlugin();
