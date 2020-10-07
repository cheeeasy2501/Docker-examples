<?php

namespace App\Widgets;

use App\Controllers\ExchangeRatesController;

class ExchangeRatesWidget extends \WP_Widget {
    private $exchangeRatesController;

    public function __construct() {
        $this->exchangeRatesController = new ExchangeRatesController();
        // Instantiate the parent object.
        parent::__construct('exchangerates_widget', 'Exchange Rates Widget',
                           [ 'description' => 'Get currencies with API Belarus National Bank']);
        add_action('widgets_init', [$this, 'exchangeRatesRegister']);
    }

    public function widget($args, $instance) {
        echo '<div class="exchange-rates__widget"> 
                    <div class="exchange-rates__currencies-title"></div>
                   '. $this->currenciesViewFrontendWidget().'
             </div>';
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

    public function form($instance) {
        return '';
    }

    public function exchangeRatesRegister() {
        register_widget(new self());
    }

    private function currenciesViewFrontendWidget() {
        $currencies = $this->exchangeRatesController->getCurrency();

        foreach ($currencies as $key => $values){
          echo '<div class="exchange-rates__currency">
                    <div class="currency-name">'.$values->name.'</div>
                    <div class="currency-data">'.$key.': '.$values->officialRate.'</div>
          </div>';
        }
    }
}
