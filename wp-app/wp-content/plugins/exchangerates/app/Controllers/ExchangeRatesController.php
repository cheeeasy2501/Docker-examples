<?php

namespace App\Controllers;

use App\Objects\Currency as CurrencyObject;
use App\Services\ExchangeRatesService;
use App\Helpers\CurrenciesHelper;

class ExchangeRatesController extends \WP_REST_Controller {
    private $exchangeRatesService;
    private $currenciesHelper;

    public function __construct() {
        $this->namespace = 'rates/v1';
        $this->rest_base = 'currency';
        $this->exchangeRatesService = new ExchangeRatesService();
        $this->currenciesHelper = new CurrenciesHelper();
        add_action('rest_api_init', [$this, 'register_routes']);
    }

    public function register_routes() {
        register_rest_route($this->namespace, "/$this->rest_base", [['methods' => 'GET', 'callback' => [$this, 'getCurrency']],]);
    }

    public function getCurrency() {
        $mode = $this->currenciesHelper->getCurrenciesMode();
        $currencies = $this->exchangeRatesService->getCurrencyByMode($mode);
        return $this->convertCurrenciesToObjects($currencies);
    }

    private function convertCurrenciesToObjects($currencies) {
        $currenciesObjects = [];
        foreach ($currencies as $key => $currencyValues) {
            $currenciesObjects[$currencyValues->Cur_Abbreviation] = new CurrencyObject($currencyValues->Cur_ID, $currencyValues->Cur_Abbreviation, $currencyValues->Cur_Scale, $currencyValues->Cur_Name, $currencyValues->Cur_OfficialRate);
        }

        return $currenciesObjects;
    }
}