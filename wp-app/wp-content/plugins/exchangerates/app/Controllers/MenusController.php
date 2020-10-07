<?php namespace App\Controllers;

use App\Functions\MenuFunctions;

class MenusController {
    private $functions;

    public function __construct() {
        $this->functions = new MenuFunctions();
        add_action('admin_menu', [$this, 'registerMenus']);
    }

    public function registerMenus() {
        $this->functions->addMenu();
        $this->functions->addSubMenu();
    }
}
