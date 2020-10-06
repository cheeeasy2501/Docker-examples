<?php
namespace App\Services;

use App\Objects\Currency as CurrencyObject;

class ExchangeRatesService {
     const ALL_CURRENCY_API = 'https://www.nbrb.by/api/exrates/rates?periodicity=0';
     const BY_CURRENCY_NAME_API = 'https://www.nbrb.by/api/exrates/rates/{{currency_name}}?parammode=2';


     public function getCurrencyByMode($mode){
         $mode = 'live';
         switch($mode) {
             case 'live': return $this->getCurrencyLive();
             case 'cron': return $this->getCurrencyCron();
             default: return $this->getCurrencyLive();
         }
     }

     public function filterOptionsValues(&$array) {
         if (($key = array_diff(0, $array)) !== false) {
             unset($array[$key]);
         }
     }
     public function changeKeys($array){
         $newArray = [];

         foreach($array as $key => $values) {

            $newArray[$values->Cur_Abbreviation] = $values;
         }

         return $newArray;
     }
    public function getCurrencyLive() {
        $currencies = [];
        $avaliableCurrenciesOptions = get_option('exchange_rates_avaliable_currencies');
        $currenciesByApi = $this->getCurrenciesByApi();
        $currencies = $this->changeKeys($currenciesByApi);
//        foreach ($currenciesByApi as $key => $currencyValues) {
//            $currencies[$currencyValues->Cur_Abbreviation] = new CurrencyObject(
//                $currencyValues->Cur_ID, $currencyValues->Cur_Abbreviation, $currencyValues->Cur_Scale,
//                $currencyValues->Cur_Name, $currencyValues->Cur_OfficialRate
//            );
//        }
//                var_dump(gettype($currencies));
//                var_dump(gettype($avaliableCurrenciesOptions));
//        return $avaliableCurrenciesOptions;
//        $this->filterOptionsValues($avaliableCurrenciesOptions);
        $avaliableCurrenciesOptions = array_diff($avaliableCurrenciesOptions,[0]);
        $avaliableCurrencies = array_intersect_key($currencies, $avaliableCurrenciesOptions);

        return $avaliableCurrencies;
    }

    public function getCurrencyCron() {
        return 'CRON';
    }

    private function replaceCurrencyName(){

    }

    private function getMode() {
        return get_option('exchange-currencies-mode');
    }


    public function getCurrenciesByApi() {
        $resoponse = wp_remote_get(self::ALL_CURRENCY_API);
        return json_decode($resoponse['body']);
    }
}