<?php

namespace App\Cron;

use App\Services\ExchangeRatesService;

class CurrencyCron {
    private $exchangeRatesService;

    public function __construct() {
        $this->exchangeRatesService = new ExchangeRatesService();
        add_filter('cron_schedules', [$this, 'everyFiveMinute']);
        add_action('wp', [$this, 'activator']);
        add_action('exchange_rates_update_currencies', [$this, 'doUpdateCurrencies']);
    }

    public function install() {
        return new self;
    }

    public function everyFiveMinute($schedules) {
        $schedules['five_min'] = array('interval' => 30, 'display' => 'Раз в 5 минут');

        return $schedules;
    }

    public function activator() {
        if (!wp_next_scheduled('exchange_rates_update_currencies')) {
            wp_schedule_event(time(), 'five_min', 'exchange_rates_update_currencies');
        }
    }

    public function deactivate() {
        wp_clear_scheduled_hook('exchange_rates_update_currencies');
    }

    public function doUpdateCurrencies() {
        $currenciesByApi = $this->exchangeRatesService->getCurrenciesByApi();
        $currencies = $this->exchangeRatesService->changeKeys($currenciesByApi);
        update_option('exchange_rates_currencies', $currencies);
    }
}