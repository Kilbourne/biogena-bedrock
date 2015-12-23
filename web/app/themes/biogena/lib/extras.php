<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;
use WP_Query;
use stdClass;
use Walker_Nav_Menu_Checklist;
/**
 * Add <body> classes
 */
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  if (!is_home() && 'area-skin-care' != get_post_type() && 'osmin-linea-pediatrica' !== basename(get_permalink()) ){
    $classes[] = 'no-full-slider';
  }
  // Add class if sidebar is active
  if (Setup\display_sidebar()) {
    $classes[] = 'sidebar-primary';
  }

  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

/**
 * Clean up the_excerpt()
 */
function excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'sage') . '</a>';
}
add_filter('excerpt_more', __NAMESPACE__ . '\\excerpt_more');

/*

 */

add_filter('wp_nav_menu_items', __NAMESPACE__ . '\\add_biogena_logo_menu', 10, 2);
function add_biogena_logo_menu( $items, $args ){
    if( $args->theme_location == 'primary_navigation' ) // only for primary menu
    {
        $new_item       = array( '<li class="menu-logo menu-item menu-item-type-post_type menu-item-object-page"><a href="'.get_home_url().'"><div class="circle-container"><div class="s-circle"><img src="' . get_template_directory_uri() . '/assets/images/logo.svg" alt=""><h3>LA RICERCA ITALIANA PER<span>IL BENESSERE DELLA CUTE</span></h3></div></div></a></li>' );
        $items          = preg_replace( '/<\/li>\s<li/', '</li>,<li',  $items );

        $array_items    = explode( ',', $items );
        array_splice( $array_items, 2, 0, $new_item ); // splice in at position 3
        $items          = implode( ',', $array_items );
            $search = '<div id="sb-search" class="search menu-item sb-search inline-block">';
    $search .= '<form method="get" id="searchform" action="'.home_url().'">';
    $search .= '<input type="text" class="field sb-search-input" name="s" id="s" />';
    $search .= '<input type="submit" class="submit sb-search-submit" name="submit" id="searchsubmit" value="Cerca" />';
    $search .= '<i class="icon-search sb-icon-search fa-search"></i>';
    $search .= '</form>';
    $search .= '</div>';
    $lang ='<div class="lang-container inline-block"><span class="it active">IT</span><span class="en">EN</span> </div>';
    $others='<li class="menu-item other">'.$search.$lang.'</li>';
    $items .= $others;
    }
    return $items;
}

function connection_patologie_to_linee() {
    p2p_register_connection_type( array(
        'name' => 'area-skin-care_to_linee',
        'from' => 'area-skin-care',
        'to' => 'linee'
    ) );
}
add_action( 'p2p_init', __NAMESPACE__ . '\\connection_patologie_to_linee' );

function connection_linee_to_prodotti() {
    p2p_register_connection_type( array(
        'name' => 'linee_to_prodotti',
        'from' => 'linee',
        'to' => 'prodotti'
    ) );
}
add_action( 'p2p_init', __NAMESPACE__ . '\\connection_linee_to_prodotti' );


add_action('admin_head-nav-menus.php', __NAMESPACE__ . '\\wpclean_add_metabox_menu_posttype_archive');

function wpclean_add_metabox_menu_posttype_archive() {
add_meta_box('wpclean-metabox-nav-menu-posttype', 'Custom Post Type Archives', __NAMESPACE__ . '\\wpclean_metabox_menu_posttype_archive', 'nav-menus', 'side', 'default');
}

function wpclean_metabox_menu_posttype_archive() {
$post_types = get_post_types(array('show_in_nav_menus' => true, 'has_archive' => true), 'object');

if ($post_types) :
    $items = array();
    $loop_index = 999999;

    foreach ($post_types as $post_type) {
        $item = new stdClass();
        $loop_index++;

        $item->object_id = $loop_index;
        $item->db_id = 0;
        $item->object = 'post_type_' . $post_type->query_var;
        $item->menu_item_parent = 0;
        $item->type = 'custom';
        $item->title = $post_type->labels->name;
        $item->url = get_post_type_archive_link($post_type->query_var);
        $item->target = '';
        $item->attr_title = '';
        $item->classes = array();
        $item->xfn = '';

        $items[] = $item;
    }

    $walker = new Walker_Nav_Menu_Checklist(array());

    echo '<div id="posttype-archive" class="posttypediv">';
    echo '<div id="tabs-panel-posttype-archive" class="tabs-panel tabs-panel-active">';
    echo '<ul id="posttype-archive-checklist" class="categorychecklist form-no-clear">';
    echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $items), 0, (object) array('walker' => $walker));
    echo '</ul>';
    echo '</div>';
    echo '</div>';

    echo '<p class="button-controls">';
    echo '<span class="add-to-menu">';
    echo '<input type="submit"' . disabled(1, 0) . ' class="button-secondary submit-add-to-menu right" value="' . __('Add to Menu', 'andromedamedia') . '" name="add-posttype-archive-menu-item" id="submit-posttype-archive" />';
    echo '<span class="spinner"></span>';
    echo '</span>';
    echo '</p>';

endif;
}
