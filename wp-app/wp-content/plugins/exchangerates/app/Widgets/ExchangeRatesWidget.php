<?php

namespace App\Widgets;

use App\Controllers\ExchangeRatesController;

class ExchangeRatesWidget extends \WP_Widget {
    private $exchangeRatesController;

    public function __construct() {
        $this->exchangeRatesController = new ExchangeRatesController();
        // Instantiate the parent object.
        parent::__construct('ExchangeRatesWidget', 'Exchange Rates Widget', ['description' => 'Get currencies with API Belarus National Bank']);
        add_action('widgets_init', [$this, 'exchangeRatesRegister']);
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        echo '<div class="exchange-rates__widget"> 
                    <div class="exchange-rates__currencies-data">
                       ' . $this->currenciesViewFrontendWidget() . '
                   </div>
             </div>';
        echo $args['after_widget'];
    }

    public function form($instance) {
    }

    public function update($new_instance, $old_instance) {
        return $new_instance;
    }

    public function exchangeRatesRegister() {
        register_widget(new self());
    }

    private function currenciesViewFrontendWidget() {
        $html = '';
        $currencies = $this->exchangeRatesController->getCurrency();
        foreach ($currencies as $key => $values) {
            $html .= '<div class="exchange-rates__currency">
                    <div class="currency-name">' . $values->name . '</div>
                    <div class="currency-data">' . $values->scale . ' ' . $key . ' - ' . $values->officialRate . ' BYN</div>
          </div>';
        }

        return $html;
    }
}
