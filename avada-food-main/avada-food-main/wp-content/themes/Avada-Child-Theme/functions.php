<?php

function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'avada-stylesheet' ) );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function avada_lang_setup() {
	$lang = get_stylesheet_directory() . '/languages';
	load_child_theme_textdomain( 'Avada', $lang );
}
add_action( 'after_setup_theme', 'avada_lang_setup' );


add_action( 'wp_enqueue_scripts', 'load_child_theme_enqueue_scripts' );

function load_child_theme_enqueue_scripts(){


	//Astra child theme stylesheet css file

	wp_enqueue_style('child-theme-css', get_stylesheet_uri());
	wp_enqueue_style('child-theme-custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css' );


	//Astra child theme javascript js file
	wp_enqueue_script('child-theme-custom-js', get_stylesheet_directory_uri() . '/assets/js/custom.js', array( 'jquery' ), true );
	
}
add_filter ( 'woocommerce_account_menu_items', 'misha_remove_my_account_links' );
function misha_remove_my_account_links( $menu_links ){
	
	unset( $menu_links['edit-address'] ); // Addresses
	
	
	//unset( $menu_links['dashboard'] ); // Remove Dashboard
	unset( $menu_links['payment-methods'] ); // Remove Payment Methods
	unset( $menu_links['orders'] ); // Remove Orders
	unset( $menu_links['downloads'] ); // Disable Downloads
	//unset( $menu_links['edit-account'] ); // Remove Account details tab
	//unset( $menu_links['customer-logout'] ); // Remove Logout link
	
	return $menu_links;
	
}

// ------------------
// 1. Register new endpoint (URL) for My Account page
// Note: Re-save Permalinks or it will give 404 error
  
function bbloomer_add_entry_support_endpoint() {
    add_rewrite_endpoint( 'entry-support', EP_ROOT | EP_PAGES );
}
  
add_action( 'init', 'bbloomer_add_entry_support_endpoint' );
  
// ------------------
// 2. Add new query var
  
function bbloomer_entry_support_query_vars( $vars ) {
    $vars[] = 'entry-support';
    return $vars;
}
  
add_filter( 'query_vars', 'bbloomer_entry_support_query_vars', 0 );
  
// ------------------
// 3. Insert the new endpoint into the My Account menu
  
function bbloomer_add_entry_support_link_my_account( $items ) {
    $items['entry-support'] = 'Entry List';
    return $items;
}
  
add_filter( 'woocommerce_account_menu_items', 'bbloomer_add_entry_support_link_my_account' );
  
// ------------------
// 4. Add content to the new tab


function my_account_menu_order() {
	$menuOrder = array(
		'dashboard'          => __( 'Dashboard', 'woocommerce' ),
		'entry-support'  => __( 'Entry List', 'woocommerce' ),
		'edit-account'    	=> __( 'Account Details', 'woocommerce' ),
		'customer-logout'    => __( 'Logout', 'woocommerce' ),
	);
	return $menuOrder;
}
add_filter ( 'woocommerce_account_menu_items', 'my_account_menu_order' );


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


add_filter('wc_get_template', 'ovr_product_meta_template', 10, 5);
function ovr_product_meta_template($located, $template_name, $args, $template_path, $default_path) {
    if ('single-product/meta.php' == $template_name) {
        $default_path = get_stylesheet_directory();
        $template_path = 'woocommerce/';
        $located = wc_locate_template($template_name, $template_path, $default_path);
    }
    return $located;
}