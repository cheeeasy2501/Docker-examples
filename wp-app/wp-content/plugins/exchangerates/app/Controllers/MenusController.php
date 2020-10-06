<?php namespace App\Controllers;

use App\Functions\MenuFunctions;

class MenusController {
    private $functions;

	public function __construct(){
	    $this->functions = new MenuFunctions();
	}

	public function addMenus() {
	    add_action('admin_menu', function () {
            $this->functions->addMenu();
            $this->functions->addSubMenu();
        });
    }
}
