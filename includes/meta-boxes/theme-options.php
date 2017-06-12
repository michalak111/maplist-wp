<?php
/**
 * CMB Theme Options
 * @version 0.1.0
 */
class ilcs_Admin {

    /**
     * Option key, and option page slug
     * @var string
     */
    private $key = 'ilcs_options';

    /**
     * Array of metaboxes/fields
     * @var array
     */
    protected $option_metabox = array();

    /**
     * Options Page title
     * @var string
     */
    protected $title = '';

    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';

    /**
     * Constructor
     * @since 0.1.0
     */
    public function __construct() {
        // Set our title
        $this->title = __( 'ILCS - Options', 'ilcs' );
        $prefix = '_ilcs_';
        // Set our CMB fields
        $this->fields = array(
            array(
                'name'       => __( 'Strona główna', 'cmb2' ),
                'id'         => $prefix . 'home_page',
                'type'       => 'select',
                'options_cb' => 'ilcs_get_your_post_type_post_options',
            ),
            array(
                'name'       => __( 'Strona słowa dnia', 'cmb2' ),
                'id'         => $prefix . 'slowo_dnia_page',
                'type'       => 'select',
                'options_cb' => 'ilcs_get_your_post_type_post_options',
            ),
            array(
                'name'       => __( 'Kategorie słowa dnia', 'cmb2' ),
                'id'         => $prefix . 'slowo_dnia_categories',
                'type'       => 'multicheck',
                'options_cb' => 'ilcs_get_categories',
            )
        );
    }

    /**
     * Initiate our hooks
     * @since 0.1.0
     */
    public function hooks() {
        add_action( 'admin_init', array( $this, 'init' ) );
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
    }

    /**
     * Register our setting to WP
     * @since  0.1.0
     */
    public function init() {
        register_setting( $this->key, $this->key );
    }

    /**
     * Add menu options page
     * @since 0.1.0
     */
    public function add_options_page() {
        $this->options_page =  add_submenu_page('edit.php?post_type=maplist', 'Ustawienia', 'Ustawienia', 'manage_options', basename(__FILE__), array( $this, 'admin_page_display' ));
    }

    /**
     * Admin page markup. Mostly handled by CMB
     * @since  0.1.0
     */
    public function admin_page_display() {
        ?>
        <div class="wrap cmb_options_page <?php echo $this->key; ?>">
            <h2><?php echo esc_html( get_admin_page_title() ) . ' - ['.strtoupper(ICL_LANGUAGE_CODE).']'; ?></h2>
            <?php cmb2_metabox_form( $this->option_metabox(), $this->key ); ?>
        </div>
        <?php
    }

    /**
     * Defines the theme option metabox and field configuration
     * @since  0.1.0
     * @return array
     */
    public function option_metabox() {
        return array(
            'id'         => 'option_metabox',
            'show_on'    => array( 'key' => 'options-page', 'value' => array( $this->key, ), ),
            'show_names' => true,
            'fields'     => $this->fields,
        );
    }

    /**
     * Public getter method for retrieving protected/private variables
     * @since  0.1.0
     * @param  string  $field Field to retrieve
     * @return mixed          Field value or exception is thrown
     */
    public function __get( $field ) {

        // Allowed fields to retrieve
        if ( in_array( $field, array( 'key', 'fields', 'title', 'options_page' ), true ) ) {
            return $this->{$field};
        }
        if ( 'option_metabox' === $field ) {
            return $this->option_metabox();
        }

        throw new Exception( 'Invalid property: ' . $field );
    }

}

// Get it started
$ilcs_Admin = new ilcs_Admin();
$ilcs_Admin->hooks();

/**
 * Wrapper function around cmb_get_option
 * @since  0.1.0
 * @param  string  $key Options array key
 * @return mixed        Option value
 */
function ilcs_get_option( $key = '' ) {
    global $ilcs_Admin;
    return cmb2_get_option( $ilcs_Admin->key, $key );
}

/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function ilcs_get_post_options( $query_args ) {

    $args = wp_parse_args( $query_args);

    $posts = get_posts( $args );

    $post_options = array();
    if ( $posts ) {
        foreach ( $posts as $post ) {
            $post_options[ $post->ID ] = $post->post_title;
        }
    }

    return $post_options;
}


function ilcs_get_your_post_type_post_options() {
    return ilcs_get_post_options( array( 'post_type' => 'page', 'numberposts' => -1 ) );
}

function ilcs_get_categories() {
    $categories = get_categories('category');
    $category_options = array();

    if ( $categories ) {
        foreach ($categories as $category) {
            $category_options[ $category->term_id ] = $category->name;
        }
    }
    return $category_options;
}