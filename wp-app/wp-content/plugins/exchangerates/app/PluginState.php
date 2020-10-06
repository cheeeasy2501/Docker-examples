<?php
namespace App;

use App\Services\ExchangeRatesService;
use App\Objects\Currency as CurrencyObject;

class PluginState{

    private $exchangeRatesService;

    public function __construct($pluginBaseFile){
        $this->exchangeRatesService = new ExchangeRatesService();
        register_activation_hook( $pluginBaseFile, [$this, 'activate'] );
        register_deactivation_hook( $pluginBaseFile, [$this, 'deactivate']);
    }

    public function activate(){
        $currencies = $this->exchangeRatesService->getCurrenciesByApi();
        $this->installDataCurrencies($currencies);
        $this->installDataAvaliableCurrencies($currencies);
    }

    public function deactivate(){

    }

    private function installDataCurrencies($currencies) {
        $currenciesOptions = get_option('exchange_rates_currencies');

        $installDataCurrencies = [];
        foreach ($currencies as $key => $currencyValues) {
            $installDataCurrencies[$currencyValues->Cur_Abbreviation] = new CurrencyObject(
                $currencyValues->Cur_ID, $currencyValues->Cur_Abbreviation, $currencyValues->Cur_Scale,
                $currencyValues->Cur_Name, $currencyValues->Cur_OfficialRate
            );
        }

        if(!$currenciesOptions) {
            add_option('exchange_rates_currencies', $installDataCurrencies);
        } else {
            update_option('exchange_rates_currencies', $installDataCurrencies);
        }
    }

    private function installDataAvaliableCurrencies($currencies) {
        $defaultAvaliableCurrencies = ['USD', 'EUR', 'RUB'];
        $avaliableCurrenciesOptions = get_option('exchange_rates_avaliable_currencies');

        foreach ($currencies as $values) {
            if(in_array($values->Cur_Abbreviation, $defaultAvaliableCurrencies)) {
                $setValue = 1;
            } else {
                $setValue = 0;
            }

            $avaliableCurrencies[$values->Cur_Abbreviation] = $setValue;
        }
//        var_dump($avaliableCurrenciesOptions);
//        var_dump(empty($avaliableCurrenciesOptions));
//        wp_die();
        if(!$avaliableCurrenciesOptions && !empty($avaliableCurrenciesOptions)) {
            add_option('exchange_rates_avaliable_currencies', $avaliableCurrencies);
        } else {
            update_option('exchange_rates_avaliable_currencies', $avaliableCurrencies);
        }
//        wp_die();
    }
}