<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 4:06 PM
 */

namespace App\Providers;


trait LeftColMenu
{


    /**
     * @param $menus
     * @return string
     */
    public static function menuGenerator($menus)
    {
        $menuHtml = '';
        foreach ($menus as $menu) {
            $menuNode = '<div class="menu_section">';
            $menuNode .= '<h3>'.$menu->get('title').'</h3>';
            if ($menu->get('menu')) {
                $menuNode .= '<ul class="nav side-menu">';
                $menuNode .= self::genarateMenuItems($menu->get('menu'));
                $menuNode .= '</ul>';
            }
            $menuNode .= '</div>';
            $menuHtml .= $menuNode;
        }
        return $menuHtml;
    }


    /**
     * Generate Menu Item
     * @param $menus
     * @return string
     */
    public static function genarateMenuItems($menus)
    {
        $html = '';
        foreach ($menus as $menu) {
            $html .= '<li><a '.($menu->get('link')? ' href="'.url($menu->get('link')).'"':'').'><i class="'
                . $menu->get('icon').'"></i> '. $menu->get('title').
                ($menu->get('label_class')?' <span class="'.$menu->get('label_class').'">'. $menu->get('label').'</span>':
                    ($menu->get('children') && $menu->get('children')->count() ?'<span class="fa fa-chevron-down"></span>':'')).'</a>';
            if ($menu->get('children')) {
                $html .= '<ul class="nav child_menu">';
                $html .= self::genarateMenuItems($menu->get('children'));
                $html .= '</ul>';
            }
            $html .= '</li>';
        }

        return $html;
    }
}