<?php
namespace App\Services;

use App\Helpers\CurrenciesHelper;

class ExchangeRatesService {
     const ALL_CURRENCY_API = 'https://www.nbrb.by/api/exrates/rates?periodicity=0';
     const BY_CURRENCY_NAME_API = 'https://www.nbrb.by/api/exrates/rates/{{currency_name}}?parammode=2';

     private $currenciesHelper;

     public function __construct(){
        $this->currenciesHelper = new CurrenciesHelper();
     }

    public function getCurrencyByMode($mode){
         switch($mode) {
             case 'live': return $this->getCurrencyLive();
             case 'cron': return $this->getCurrencyCron();
             default: return $this->getCurrencyLive();
         }
     }

    public function getCurrencyLive() {
        $avaliableCurrenciesOptions = $this->currenciesHelper->getAvaliableCurrenciesOptions();
        $currenciesByApi = $this->getCurrenciesByApi();
        $currencies = $this->changeKeys($currenciesByApi);
        $avaliableCurrenciesOptions = array_diff($avaliableCurrenciesOptions,[0]);
        $avaliableCurrencies = array_intersect_key($currencies, $avaliableCurrenciesOptions);

        return $avaliableCurrencies;
    }

    public function getCurrencyCron() {
        $avaliableCurrenciesOptions = $this->currenciesHelper->getAvaliableCurrenciesOptions();
        $currencies = $this->currenciesHelper->getCurrenciesOptions();
        $avaliableCurrenciesOptions = array_diff($avaliableCurrenciesOptions,[0]);
        $avaliableCurrencies = array_intersect_key($currencies, $avaliableCurrenciesOptions);

        return $avaliableCurrencies;
    }

    public function getCurrenciesByApi() {
        $resoponse = wp_remote_get(self::ALL_CURRENCY_API);
        return json_decode($resoponse['body']);
    }

    public function changeKeys($array){
        $newArray = [];
        foreach($array as $key => $values) {
            $newArray[$values->Cur_Abbreviation] = $values;
        }

        return $newArray;
    }
}