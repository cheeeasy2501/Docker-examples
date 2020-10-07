<?php

namespace App;

use App\Services\ExchangeRatesService;
use App\Cron\CurrencyCron;
use App\Helpers\CurrenciesHelper;

class PluginState {

    private $exchangeRatesService;
    private $currencyCron;
    private $currenciesHelper;

    public function __construct($pluginBaseFile) {
        $this->exchangeRatesService = new ExchangeRatesService();
        $this->currencyCron = new CurrencyCron();
        $this->currenciesHelper = new CurrenciesHelper();
        register_activation_hook($pluginBaseFile, [$this, 'activate']);
        register_deactivation_hook($pluginBaseFile, [$this, 'deactivate']);
    }

    public function activate() {
        $currenciesApi = $this->exchangeRatesService->getCurrenciesByApi();
        $currencies = $this->exchangeRatesService->changeKeys($currenciesApi);
        $this->installDataCurrencies($currencies);
        $this->installDataAvaliableCurrencies($currencies);
        $this->setCurrenciesMode();
        $this->currencyCron->install();
    }

    public function deactivate() {
        $this->currencyCron->deactivate();
    }

    private function installDataCurrencies($currencies) {
        $currenciesOptionName = $this->currenciesHelper->getOptionNames('currencies');
        $this->currenciesHelper->saveOption($currenciesOptionName, $currencies);
    }

    private function installDataAvaliableCurrencies($currencies) {
        $defaultAvaliableCurrencies = ['USD', 'EUR', 'RUB'];

        foreach ($currencies as $values) {
            if (in_array($values->Cur_Abbreviation, $defaultAvaliableCurrencies)) {
                $setValue = 1;
            } else {
                $setValue = 0;
            }

            $avaliableCurrencies[$values->Cur_Abbreviation] = $setValue;
        }

        $avaliableCurrenciesOptionName = $this->currenciesHelper->getOptionNames('avaliable_currencies');
        $this->currenciesHelper->saveOption($avaliableCurrenciesOptionName, $avaliableCurrencies);
    }

    private function setCurrenciesMode() {
        $defaultMode = 'live';
        $currenciesOptionName = $this->currenciesHelper->getOptionNames('mode');
        $this->currenciesHelper->saveOption($currenciesOptionName, $defaultMode);
    }
}