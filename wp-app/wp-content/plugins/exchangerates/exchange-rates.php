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
use App\Widgets\ExchangeRatesWidget;

define('PLUGIN_BASE_FILE', __FILE__);

//Install / Uninstall
(new State(PLUGIN_BASE_FILE));

//Admin Menu
(new MenusController);

//REST Controller
(new ExchangeRatesController());

//Widget
 new ExchangeRatesWidget();

