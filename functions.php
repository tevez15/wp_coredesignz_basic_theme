<?php
/* WIDGETS */
function register_widget_areas() {

    // Widget code goes here...
    register_sidebar([
        'name' => 'Sidebar',
        'id' => 'sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);

    register_sidebar([
        'name' => 'Footer-1',
        'id' => 'footer_1',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);

    register_sidebar([
        'name' => 'Footer-2',
        'id' => 'footer_2',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);

    register_sidebar([
        'name' => 'Footer-3',
        'id' => 'footer_3',
        'before_widget' => '<div class="widget">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ]);

}
  
add_action( 'widgets_init', 'register_widget_areas' );
 
// Add custom logo
function themename_custom_logo_setup() {
    $defaults = [
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ];

    add_theme_support( 'custom-logo', $defaults );
}

add_action( 'after_setup_theme', 'themename_custom_logo_setup' );

// Register Menus
function register_my_menus() {
    register_nav_menus([
        'header-menu' => __( 'Header Menu' ),
        'footer-menu-1' => __( 'Footer Menu 1' ),
        'footer-menu-2' => __( 'Footer Menu 2' ),
        'footer-menu-3' => __( 'Footer Menu 3' ),
    ]);
}
add_action( 'init', 'register_my_menus' );

/**
 * Return a clean menu
 * 
 * @param array $menuOptions
 * 
 * @return string
 */
function clean_custom_menus($menuOptions) {

    if (!empty($menuOptions['menuName'])) {
        $menuName = $menuOptions['menuName'];
        $navClass = (!empty($menuOptions['navClass']) ? $menuOptions['navClass'] : '');
        $aClass = (!empty($menuOptions['aClass']) ? $menuOptions['aClass'] : '');
        $showTitle = (empty($menuOptions['showTitle']) ? false : $menuOptions['showTitle']);

        $locations = get_nav_menu_locations();

        if (($locations = get_nav_menu_locations()) && isset($locations[$menuName])) {
            $menu = wp_get_nav_menu_object($locations[$menuName]);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            $menu_list = '';


            if ($showTitle) {
                $menu_list .= "<h5 class='title_menu'>{$menu->name}</h5>";
            }

            $menu_list .= "<nav class='{$navClass}'>";
            foreach ((array) $menu_items as $menu_item) {
                $title = $menu_item->title;
                $url = $menu_item->url;
                $menu_list .= "<a class='{$aClass}' href='{$url}'>{$title}</a>";
            }
            $menu_list .= "</nav>";
        } else {
            // empty
        }
        
        echo $menu_list;
    }
}
?>