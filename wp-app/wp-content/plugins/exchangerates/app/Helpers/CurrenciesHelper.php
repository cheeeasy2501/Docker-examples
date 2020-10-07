<?php

namespace App\Helpers;

class CurrenciesHelper {

    const optionNames = [
        'avaliable_currencies'  =>  'exchange_rates_avaliable_currencies',
        'currencies' => 'exchange_rates_currencies',
        'mode' => 'exchange_rates_currencies_mode'
    ];

    public function getOptionNames($string) {
        return self::optionNames[$string];
    }

    public function getAvaliableCurrenciesOptions() {
        return get_option(self::optionNames['avaliable_currencies']);
    }

    public function getCurrenciesOptions() {
        return get_option(self::optionNames['currencies']);
    }

    public function getCurrenciesMode() {
        return get_option(self::optionNames['mode']);
    }

    public function saveOption($optionName, $optionValue) {
        $ifOptionExists = get_option($optionName);

        if (!$ifOptionExists && !empty($ifOptionExists)) {
            add_option($optionName, $optionValue);
        } else {
            update_option($optionName, $optionValue);
        }
    }
}