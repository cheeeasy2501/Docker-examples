<?php
/**
 * Plugin Name: MVC Plugin
 * Version: 0.1.0
 * Description: A nice description.
 * Author: Lazy Code Lab
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\Admin\MenusController;

( new MenusController );