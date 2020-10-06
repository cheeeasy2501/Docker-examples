<?php

namespace App\Helpers;

class CurrenciesHelper {
    public function getAvaliableCurrenciesOptions() {
        return get_option('exchange_rates_avaliable_currencies');
    }

    public function getCurrenciesOptions() {
        return get_option('exchange_rates_currencies');
    }

    public function getCurrenciesMode() {
        return get_option('exchange_rates_currencies_mode');
    }
}