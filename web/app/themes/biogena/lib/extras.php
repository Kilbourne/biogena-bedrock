<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;
use WP_Query;
use stdClass;
use Walker_Nav_Menu_Checklist;
require_once dirname(__DIR__).'/lib/mobiledetect/mobiledetectlib/Mobile_Detect.php';
use Mobile_Detect;
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
  if (!is_home() && __('linee','sage')	 != get_post_type() && __('osmin-linea-pediatrica','sage') !== basename(get_permalink()) || is_search() ){
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
        $new_item       = array( '<li class="menu-logo menu-item menu-item-type-post_type menu-item-object-page"><a href="'.get_home_url().'"><div class="circle-container"><div class="s-circle"><img src="' . get_template_directory_uri() . '/dist/images/logo.svg" alt=""><h3>'.__("LA RICERCA ITALIANA PER<span>IL BENESSERE DELLA CUTE</span>","sage").'</h3><div class="tricolore"><img src="' . get_template_directory_uri() . '/dist/images/Tricolore.jpg" alt=""></div></div></div></a></li>' );
        $items          = preg_replace( '/<\/li>\s<li/', '</li>-BIOGENADELIMITER-<li',  $items );

        $array_items    = explode( '-BIOGENADELIMITER-', $items );
        array_splice( $array_items, 2, 0, $new_item ); // splice in at position 3
        $items          = implode( '', $array_items );
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
        'from' => __('area-skin-care','sage')	,
        'to' => __('linee','sage')
    ) );
}
add_action( 'p2p_init', __NAMESPACE__ . '\\connection_patologie_to_linee' );

function connection_linee_to_prodotti() {
    p2p_register_connection_type( array(
        'name' => 'linee_to_prodotti',
        'from' => __('linee','sage')	,
        'to' => __('prodotti','sage')
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

function materiali_riservati_func( $atts ){
  $cont='';
   $cont.="<h1> ".__("Materiali riservati","sage")."</h1>
  <div>";

    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'post_type'        => 'area_riservata',
      );
      $posts_array = get_posts( $args );
      foreach ($posts_array as $key => $value) {
        $cont.="<div class='reserved'><h3>
          ".$value->post_title."
          </h3><ul>
          ";
          $allegati=get_field('allegati',$value->ID);
          foreach ($allegati as $key2 => $value2) {
           $cont.='<li><a target="_blank" href="'.$value2['file']['url'].'" title="'.$value2['file']['title'].'">'.$value2['label'].'</a>
            </li>';
          }
          $cont.="

          </ul>
        </div>   " ;
      }


$cont.="</div>";
  return $cont;
}
add_shortcode( 'materiali_riservati', __NAMESPACE__ . '\\materiali_riservati_func' );

function video_azienda_func( $atts ){


$detect = new Mobile_Detect;

// Any mobile device (phones or tablets).
if ( !$detect->isMobile() ) {
 return '<div class=" boxx with-img video">
            <div class="boxx-wrapper">
                <h3>La parola al fondatore</h3>'.do_shortcode('[video src="http://www.biogena-lab.com/app/uploads/2015/11/Filmato-Green-1-1.m4v"][/video]').'

<img class="alignleft size-full wp-image-1620" src="http://www.biogena-lab.com/app/uploads/2016/01/azienda-4.png" alt="azienda-01" width="180" height="300" />
            </div>
        </div>';

}

}
add_shortcode( 'video_azienda', __NAMESPACE__ . '\\video_azienda_func' );
add_action( 'wp_ajax_nopriv_ajax_login',  __NAMESPACE__ . '\\ajax_login' );

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Nome Utente o Password errata','sage')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...','sage')));
    }

    die();
}
add_action( 'save_post_area-skin-care', __NAMESPACE__ . '\\delete_transient_on_update' );
add_action( 'save_post_linee', __NAMESPACE__ . '\\delete_transient_on_update' );
add_action( 'save_post_prodotti',__NAMESPACE__ . '\\delete_transient_on_update' );
function delete_transient_on_update($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if ( wp_is_post_revision( $post_id ) ) return;
    $type=get_post_type( $post_id );

    delete_transient( 'biogena_data_linee');
    delete_transient( 'biogena_data_area-skin-care');
    delete_transient( 'biogena_data_prodotti');
    delete_transient( 'biogena_data_area-baby');
}

function linea_single_product_ajax() {
  $title=isset($_POST['prodottoSingle']) && $_POST['prodottoSingle'] !==''?$_POST['prodottoSingle']:$_POST['title'];

  global $post;
  $post = get_page_by_title( urldecode($title), 'OBJECT', __('prodotti','sage') );
  query_posts( array('p'=>$post->ID,'post_type'=>__('prodotti','sage')));
  ob_start();
  include_once(locate_template('templates/content-single-prodotti.php'));
  $output = ob_get_contents();
  ob_end_clean();
  echo $output;
  wp_die();
}
add_action( 'wp_ajax_get_template_single', __NAMESPACE__ . '\\linea_single_product_ajax' );
add_action( 'wp_ajax_nopriv_get_template_single', __NAMESPACE__ . '\\linea_single_product_ajax' );

