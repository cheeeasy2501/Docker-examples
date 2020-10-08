<?


function exchange_rates_get_settings() {
	return apply_filters( 'pn_get_settings', get_option( PN_TEXTDOMAIN . '-settings' ) );
}
	function exchange_rates_function($title) {
		return $title.'@';
	}

	/*
	 * Подключаем JS и CSS стили
	 * return void
	 * */
	function exchange_rates_scripts() {
		wp_enqueue_script('vue', 'https://cdn.jsdelivr.net/npm/vue/dist/vue.js', [], null);
		//wp_enqueve_script('название в системе','путь к файлу', $deps - зависимости(Jquery));
		wp_enqueue_script(
					'exchange-rates-scripts', plugins_url('/Assets/js/exchange-rates-scripts.js', __FILE__),
					array(('jquery')), null, true
		);

		wp_enqueue_style('exchange-rates-style',plugins_url('/css/exchange-rates-style.css'), null,
		null);

	}

	add_action('wp_enqueue_scripts', 'exchange_rates_scripts');