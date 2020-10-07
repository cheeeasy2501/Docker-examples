<?php

namespace App\Views;

use App\Helpers\CurrenciesHelper;

class MenuView {
    private $currenciesHelper;

    public function __construct() {
        $this->currenciesHelper = new CurrenciesHelper();
        add_action('admin_init', [$this, 'settingPage']);
    }

    public function menuView() {
        echo '<h1>' . get_admin_page_title() . '</h1>';
    }

    public function subMenuGeneralView() {
        add_action('admin_init', [$this, 'settingPage']);

        echo '<form method="post" action="options.php">';
        settings_fields("exchange-rates");
        do_settings_sections("exchange-rates-general");
        submit_button();
        echo '</form>'; ?>
        <?php
    }

    public function settingPage() {
        add_settings_section("exchange-rates-section", "General", null, "exchange-rates-general");

        add_settings_field("avaliable_currencies", "Avaliable Currencies", [$this, 'adminCurrenciesDisplay'], "exchange-rates-general", "exchange-rates-section");
        add_settings_field("mode_currencies", "Mode", [$this, 'adminCurrenciesModeDisplay'], "exchange-rates-general", "exchange-rates-section");

        register_setting("exchange-rates", "exchange_rates_avaliable_currencies");
        register_setting("exchange-rates", "exchange_rates_currencies_mode");
    }

    public function adminCurrenciesDisplay() {
        $currencies = $this->currenciesHelper->getAvaliableCurrenciesOptions();
        echo '<div class="exchange-rates__currencies">';
        foreach ($currencies as $key => $value) {
            echo '<div class="exchange-rates__currency"> 
                     <input type="hidden" name="exchange_rates_avaliable_currencies[' . $key . ']" value="0" />';
            echo '<input type="checkbox" name="exchange_rates_avaliable_currencies[' . $key . ']" value="1"' . checked(1, $value, false) . ' />
                     <label for="exchange_rates_avaliable_currencies[' . $key . ']">' . $key . '</label></div>';
        }
        echo '</div>';
    }

    public function adminCurrenciesModeDisplay() {
        $mode = $this->currenciesHelper->getCurrenciesMode();
        echo '<div class="exchange-rates__mode">
                <input type="radio" name="exchange_rates_currencies_mode" value="live" ' . checked("live", $mode, false) . '/> Live 
                <input type="radio" name="exchange_rates_currencies_mode" value="cron" ' . checked("cron", $mode, false) . ' /> Cron
              </div>';
    }
}