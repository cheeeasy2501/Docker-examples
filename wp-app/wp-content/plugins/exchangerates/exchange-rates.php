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

//add_filter('cron_schedules',  'everyFiveMinute');
//add_action('wp',  'activator');
//add_action('exchange_rates_update_currencies', 'doUpdateCurrencies');
//
// function activator() {
//    if (!wp_next_scheduled('exchange_rates_update_currencies')) {
//        wp_schedule_event(time(), 'five_min', 'exchange_rates_update_currencies');
//    }
//}
//
// function doUpdateCurrencies() {
//    $currenciesByApi = $this->exchangeRatesService->getCurrenciesByApi();
//    $currencies = $this->exchangeRatesService->changeKeys($currenciesByApi);
//    update_option('exchange_rates_currencies', $currencies);
//}
//
// function everyFiveMinute($schedules) {
//    $schedules['five_min'] = array('interval' => 60 * 5, 'display' => 'Раз в 5 минут');
//
//    return $schedules;
//}

