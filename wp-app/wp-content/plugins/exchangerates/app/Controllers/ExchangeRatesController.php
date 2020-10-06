<?php
namespace App\Controllers;

use App\Services\ExchangeRatesService;

class ExchangeRatesController extends \WP_REST_Controller {
	private $exchangeRatesService;

	public function __construct() {
		$this->namespace = 'rates/v1';
		$this->rest_base = 'currency';
		$this->exchangeRatesService = new ExchangeRatesService();
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
		$settings = [ 'mode' => 'live'];
            //getCurrencyByMode
		return $this->exchangeRatesService->getCurrencyLive();
	}
}