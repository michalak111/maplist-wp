<?php
/**
 * Created by PhpStorm.
 * User: Johnny
 * Date: 2017-02-02
 * Time: 22:18
 */

// Register Custom Post Type
function maplist_custom_post_type() {

    $labels = array(
        'name'                  => _x( 'MapList Locations', 'Post Type General Name', 'text_domain' ),
        'singular_name'         => _x( 'MapList Location', 'Post Type Singular Name', 'text_domain' ),
        'menu_name'             => __( 'MapList Locations', 'text_domain' ),
        'name_admin_bar'        => __( 'MapList Locations', 'text_domain' ),
        'archives'              => __( 'Archiwum', 'text_domain' ),
        'attributes'            => __( 'Atrybuty', 'text_domain' ),
        'parent_item_colon'     => __( 'Rodzic:', 'text_domain' ),
        'all_items'             => __( 'Wszystkie lokalizacje', 'text_domain' ),
        'add_new_item'          => __( 'Dodaj nowy', 'text_domain' ),
        'add_new'               => __( 'Dodaj nowy', 'text_domain' ),
        'new_item'              => __( 'Nowy', 'text_domain' ),
        'edit_item'             => __( 'Edytuj', 'text_domain' ),
        'update_item'           => __( 'Uaktualnij', 'text_domain' ),
        'view_item'             => __( 'Zobacz', 'text_domain' ),
        'view_items'            => __( 'Zobacz wszystkie', 'text_domain' ),
        'search_items'          => __( 'Wyszukaj', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'text_domain' ),
        'items_list'            => __( 'Items list', 'text_domain' ),
        'items_list_navigation' => __( 'Items list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter items list', 'text_domain' ),
    );
    $args = array(
        'label'                 => __( 'MapList Location', 'text_domain' ),
        'description'           => __( 'MapList Locations', 'text_domain' ),
        'labels'                => $labels,
        'supports'              => array( 'title', ),
        'taxonomies'            => array( 'category0' ),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-location',
    );
    register_post_type( 'maplist', $args );

}

add_action( 'init', 'maplist_custom_post_type', 0 );