<?php namespace App\Admin;

class MenusController {
	public function __construct()
	{
		add_action( 'admin_menu', [$this, 'addMenus'] );
	}

	public function initializeMenus()
	{
		return [
			'wp-mvc-plugin' => [
				'page_title' => 'MVC Plugin',
				'menu_title' => 'MVC Plugin',
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
