<?php
namespace App\Functions;

use App\Views\MenuViews;

class MenuFunctions {

    private $views;

    public function __construct(){
        $this->views = new MenuViews();
    }

    public function initializeMenus(){
        return [
            'exchange-rates' => [
                'page_title' => 'Exchange Rates',
                'menu_title' => 'Exchange Rates',
                'capability' => 'administrator',
                'function' => [$this->views, 'menuView'],
                'icon_url' => '',
                'priority' => 90,
            ],
        ];
    }

    public function initializeSubMenus() {

        return [
            'exchange-rates' => [
                'parent_slug'=>'exchange-rates',
                'page_title' => 'General settings',
                'menu_title' => 'General',
                'capability' => 'administrator',
                'function' => [$this->views, 'subMenuGeneralView'],
                'icon_url' => '',
                'priority' => 10,
            ]
        ];
    }

    public function addMenu(){
        foreach ( $this->initializeMenus() as $menuSlug => $menu ) {
            add_menu_page( $menu['page_title'], $menu['menu_title'], $menu['capability'], $menuSlug, $menu['function'], $menu['icon_url'], $menu['priority'] );
        }
    }

    public function addSubMenu(){
        foreach ($this->initializeSubMenus() as $subMenuSlug => $subMenu) {
            add_submenu_page( $subMenu['parent_slug'],$subMenu['page_title'], $subMenu['menu_title'], $subMenu['capability'], $subMenuSlug, $subMenu['function'],
               $subMenu['priority']);
        }
    }
}