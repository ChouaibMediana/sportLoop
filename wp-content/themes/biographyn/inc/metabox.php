<?php
/**
 * Metabox file.
 *
 * This is the template that shows the metaboxes.
 *
 * @package Theme Palace
 * @subpackage  Biographyn
 * @since  Biographyn 1.0.0
 */

/**
 * Class to Renders and save metabox options
 *
 * @since  Biographyn 1.0.0
 */
class Biographyn_MetaBox {
    private $meta_box;

    private $fields;

    /**
    * Constructor
    *
    * @since  Biographyn 1.0.0
    *
    * @access public
    *
    */
    public function __construct( $meta_box_id, $meta_box_title, $post_type ) {
        
        $this->meta_box = array (
                            'id'        => $meta_box_id,
                            'title'     => $meta_box_title,
                            'post_type' => $post_type,
                            );

        $this->fields = array(
                            'Biographyn-sidebar-position',
                            'Biographyn-selected-sidebar',
                            );


        // Add metaboxes
        add_action( 'add_meta_boxes', array( $this, 'add' ) );
        
        add_action( 'save_post', array( $this, 'save' ) );  
    }

    /**
    * Add Meta Box for multiple post types.
    *
    * @since  Biographyn 1.0.0
    *
    * @access public
    */
    public function add($postType) {
        if( in_array( $postType, $this->meta_box['post_type'] ) ) {
            add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType, 'side' );
        }
    }

    /**
    * Renders metabox
    *
    * @since  Biographyn 1.0.0
    *
    * @access public
    */
    public function show() {
        global $post;

        $layout_options         = biographyn_sidebar_position();
        $sidebar_options        = biographyn_selected_sidebar();
        
        
        // Use nonce for verification  
        wp_nonce_field( basename( __FILE__ ), 'biographyn_custom_meta_box_nonce' );

        // Begin the field table and loop  ?>  
        <div id="Biographyn-ui-tabs" class="ui-tabs">
            <ul class="Biographyn-ui-tabs-nav" id="Biographyn-ui-tabs-nav">
                <li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'biographyn' ); ?></a></li>
                <li><a href="#frag2"><?php esc_html_e( 'Select Sidebar', 'biographyn' ); ?></a></li>
            </ul> 

            <div id="frag1" class="catch_ad_tabhead">
                <table id="layout-options" class="form-table" width="100%">
                    <tbody>
                        <tr>
                            <?php  
                                $metalayout = get_post_meta( $post->ID, 'Biographyn-sidebar-position', true );
                                if( empty( $metalayout ) ){
                                    $metalayout='';
                                }

                                foreach ( $layout_options as $value => $url ) :
                                    echo '<label>';
                                    echo '<input type="radio" name="Biographyn-sidebar-position" value="' . esc_attr( $value ) . '" ' . checked( (string) $metalayout, (string) $value, false ) . ' />';
                                    echo '<img src="' . esc_url( $url ) . '"/>';
                                    echo '</label>';
                                endforeach;
                            ?>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div id="frag2" class="catch_ad_tabhead">
                <table id="sidebar-metabox" class="form-table" width="100%">
                    <tbody> 
                        <tr>
                            <?php
                            $metasidebar = get_post_meta( $post->ID, 'Biographyn-selected-sidebar', true );
                            if ( empty( $metasidebar ) ){
                                $metasidebar='sidebar-1';
                            } 
                            foreach ( $sidebar_options as $field => $value ) {  
                            ?>
                                <td style="vertical-align: top;">
                                    <label class="description">
                                        <input type="radio" name="Biographyn-selected-sidebar" value="<?php echo esc_attr( $field ); ?>" <?php checked( (string) $field, (string) $metasidebar ); ?>/>&nbsp;&nbsp;<?php echo esc_html( $value ); ?>
                                    </label>
                                </td>
                                
                            <?php
                            } // end foreach 
                            ?>
                        </tr>
                    </tbody>
                </table>        
            </div>

        </div>
    <?php 
    }

    /**
     * Save custom metabox data
     * 
     * @action save_post
     *
     * @since  Biographyn 1.0.0
     *
     * @access public
     */
    public function save( $post_id ) { 
    
        // Checks save status
        $is_autosave = wp_is_post_autosave( $post_id );
        $is_revision = wp_is_post_revision( $post_id );
        $is_valid_nonce = ( isset( $_POST[ 'biographyn_nonce' ] ) && wp_verify_nonce( sanitize_key( $_POST[ 'biographyn_nonce' ] ), basename( __FILE__ ) ) ) ? 'true' : 'false';

        // Exits script depending on save status
        if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
            return;
        }
      
        foreach ( $this->fields as $field ) {      
            // Checks for input and sanitizes/saves if needed
            if( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
            }
        } // end foreach         
    }
}
$post_types = array( 'page', 'post' );

$biographyn_metabox = new Biographyn_MetaBox(
                                    'Biographyn-options',     //metabox id
                                    esc_html__( ' Biographyn Meta Options', 'biographyn' ), //metabox title
                                    $post_types            //metabox post types
                                    );

/**
 * Enqueue scripts and styles for Metaboxes
 * @uses wp_enqueue_script, and  wp_enqueue_style
 *
 * @since  Biographyn 1.0.0
 */
function biographyn_enqueue_metabox_scripts( $hook ) {

    if( $hook == 'post.php' || $hook == 'post-new.php'  ){

        wp_enqueue_script( 'jquery-ui-tabs' );
        //Scripts
        wp_enqueue_script( 'Biographyn-metabox', get_template_directory_uri() . '/assets/js/metabox' . biographyn_min() . '.js', array( 'jquery', 'jquery-ui-tabs' ), '2013-10-05' );
        //CSS Styles
        wp_enqueue_style( 'Biographyn-metabox-tabs', get_template_directory_uri() . '/assets/css/metabox-tabs' . biographyn_min() . '.css' );
    }
    return;
}
add_action( 'admin_enqueue_scripts', 'biographyn_enqueue_metabox_scripts', 11 );
