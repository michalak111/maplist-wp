<?php
add_action( 'cmb2_admin_init', 'maplist_locations_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function maplist_locations_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_maplist_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'location_metabox',
        'title'         => __( 'Location', 'cmb2' ),
        'object_types'  => array( 'maplist', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    // Regular text field
    $cmb->add_field( array(
        'name'       => __( 'Lat', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'lat',
        'type'       => 'text',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Lng', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'lng',
        'type'       => 'text',
    ) );

    $cmb->add_field( array(
        'name'           => 'Obszar',
        'desc'           => 'Description Goes Here',
        'id'             => $prefix . 'area',
        'taxonomy'       => 'area', //Enter Taxonomy Slug
        'type'           => 'taxonomy_select',
        'remove_default' => 'true' // Removes the default metabox provided by WP core. Pending release as of Aug-10-16
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Address', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'address',
        'type'       => 'textarea',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Description', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'description',
        'type'       => 'wysiwyg',
    ) );

    $cmb->add_field( array(
        'name'       => __( 'Gallery', 'cmb2' ),
        'desc'       => __( 'field description (optional)', 'cmb2' ),
        'id'         => $prefix . 'gallery',
        'type'       => 'file_list',
    ) );
}