<?php
namespace App\Controllers;

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
	}

	public function initPlugin() {
		add_action( 'rest_api_init', function () {
			$this->register_routes();
		});
	}

	public function register_routes() {
		register_rest_route( $this->namespace, "/$this->rest_base",
			[
				[
					'methods' => 'GET',
					'callback' => [ $this, 'getCurrency']
				],
			]);
	}


	public function getCurrency() {
		$mode = $this->currenciesHelper->getCurrenciesMode();

		return $this->exchangeRatesService->getCurrencyByMode($mode);
	}
}