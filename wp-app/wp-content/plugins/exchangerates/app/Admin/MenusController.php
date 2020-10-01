<?php namespace App\Admin;

class MenusController {
	public function __construct()
	{
		add_action( 'admin_menu', [$this, 'addMenus'] );
	}

	public function initializeMenus()
	{
		return [
			'exchange-rates' => [
				'page_title' => 'Exchange Rates',
				'menu_title' => 'Exchange Rates',
				'capability' => 'administrator',
				'function' => [$this, 'menuView'],
				'icon_url' => '',
				'priority' => 90,
			],
		];
	}

	public function menuView()
	{
		echo '<h1>Page title</h1>';
	}

	public function addMenus()
	{
		foreach ( $this->initializeMenus() as $menuSlug => $menu ) {
			add_menu_page( $menu['page_title'], $menu['menu_title'], $menu['capability'], $menuSlug, $menu['function'], $menu['icon_url'], $menu['priority'] );
		}
	}
}
