<?php

if (!defined('ABSPATH'))
  exit;

if (!class_exists('OCWQV_admin_menu')) {

    class OCWQV_admin_menu {

        protected static $OCWQV_instance;

        function OCWQV_submenu_page() {
           add_submenu_page( 'woocommerce', 'Quick View', 'Quick View', 'manage_options', 'quick-view', array($this, 'OCWQV_callback'));
        }


        function OCWQV_callback() {
            ?>    
                <div class="wrap">
                    <h2><u>Quick View</u></h2>
                    <?php if(isset($_REQUEST['message']) && $_REQUEST['message'] == 'success'){ ?>
                        <div class="notice notice-success is-dismissible">
                            <p><strong>Settings Saved Successfully.</strong></p>
                        </div>
                    <?php } ?>
                </div>
                <div class="ocwqv-container">
                    <form method="post" >
                      <?php wp_nonce_field( 'ocwqv_nonce_action', 'ocwqv_nonce_field' ); ?>   
                        <div id="wfc-tab-general" class="tab-content current">
                            <div class="cover_div">
                              <h2>General Settings</h2>
                                <div class="ocwqv_cover_div">
                                    <table class="ocwqv_data_table">
                                        <tr>
                                            <th>Enable Quick View Button</th>
                                            <td>
                                                <input type="checkbox" name="ocwqv_quk_btn" value="yes" <?php if (get_option( 'ocwqv_quk_btn', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Enable Quick View Button on Mobile</th>
                                            <td>
                                                <input type="checkbox" name="ocwqv_mbl_btn" value="yes" <?php if (get_option( 'ocwqv_mbl_btn', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Show (in quick view popup)</th>
                                            <td class="ocwqv_show_td">
                                                <input type="checkbox" name="ocwqv_show_images" value="yes" <?php if (get_option( 'ocwqv_show_images', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Images</label>

                                                <input type="checkbox" name="ocwqv_show_title" value="yes" <?php if (get_option( 'ocwqv_show_title', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Title</label>

                                                <input type="checkbox" name="ocwqv_show_ratings" value="yes" <?php if (get_option( 'ocwqv_show_ratings', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Ratings</label>

                                                <input type="checkbox" name="ocwqv_show_price" value="yes" <?php if (get_option( 'ocwqv_show_price', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Price</label>

                                                <input type="checkbox" name="ocwqv_show_description" value="yes" <?php if (get_option( 'ocwqv_show_description', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Description</label>

                                                <input type="checkbox" name="ocwqv_show_atc" value="yes" <?php if (get_option( 'ocwqv_show_atc', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Add to Cart</label>

                                                <input type="checkbox" name="ocwqv_show_meta" value="yes" <?php if (get_option( 'ocwqv_show_meta', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Meta</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Enable View Details Button</th>
                                            <td>
                                                <input type="checkbox" name="ocwqv_viewdetails_btn" value="yes" <?php if (get_option( 'ocwqv_viewdetails_btn', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>View Details button with product link within popup</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Enable Lightbox</th>
                                            <td>
                                                <input type="checkbox" name="ocwqv_lightbox_enable" value="yes" <?php if (get_option( 'ocwqv_lightbox_enable', 'yes' ) == "yes" ) {echo 'checked="checked"';} ?>>
                                                <label>Product Images will open in lightbox.</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Ajax Add to Cart</th>
                                            <td>
                                                <input type="checkbox" name="ocwqv_ajax_atc" value="yes" <?php if (get_option( 'ocwqv_ajax_atc' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Add items to cart, without refreshing page.</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Quick View Popup Background Color</th>
                                            <td>
                                               <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo get_option( 'ocwqv_qw_popup_bg', 'rgba(0,0,0,0.4)' ); ?>" name="ocwqv_qw_popup_bg" value="<?php echo get_option( 'ocwqv_qw_popup_bg', 'rgba(0,0,0,0.4)' ); ?>"/> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Quick View Popup Loader</th>
                                            <td class="ocwqv_icon_choice">
                                                <input type="radio" name="ocwqv_qw_popup_loader" value="loader-1.gif" <?php if (get_option( 'ocwqv_qw_popup_loader' ) == "loader-1.gif" || empty(get_option( 'ocwqv_qw_popup_loader' ))) {echo 'checked="checked"';} ?>>
                                                <label>
                                                    <img src="<?php echo OCWQV_PLUGIN_DIR . '/images/loader-1.gif' ?>" alt="">
                                                </label>
                                                <input type="radio" name="ocwqv_qw_popup_loader" value="loader-2.gif" <?php if (get_option( 'ocwqv_qw_popup_loader' ) == "loader-2.gif" ) {echo 'checked="checked"';} ?>>
                                                <label>
                                                    <img src="<?php echo OCWQV_PLUGIN_DIR . '/images/loader-2.gif' ?>" alt="">
                                                </label>
                                                <input type="radio" name="ocwqv_qw_popup_loader" value="loader-3.gif" <?php if (get_option( 'ocwqv_qw_popup_loader' ) == "loader-3.gif" ) {echo 'checked="checked"';} ?>>
                                                <label>
                                                    <img src="<?php echo OCWQV_PLUGIN_DIR . '/images/loader-3.gif' ?>" alt="">
                                                </label>
                                                <input type="radio" name="ocwqv_qw_popup_loader" value="loader-4.gif" <?php if (get_option( 'ocwqv_qw_popup_loader' ) == "loader-4.gif" ) {echo 'checked="checked"';} ?>>
                                                <label>
                                                    <img src="<?php echo OCWQV_PLUGIN_DIR . '/images/loader-4.gif' ?>" alt="">
                                                </label>
                                                <input type="radio" name="ocwqv_qw_popup_loader" value="loader-5.gif" <?php if (get_option( 'ocwqv_qw_popup_loader' ) == "loader-5.gif" ) {echo 'checked="checked"';} ?>>
                                                <label>
                                                    <img src="<?php echo OCWQV_PLUGIN_DIR . '/images/loader-5.gif' ?>" alt="">
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
	                                        <th>Quick View Popup Close Icon</th>
	                                        <td class="ocwqv_icon_choice">
	                                            <input type="radio" name="ocwqv_qvppc_icon" value="fa fa-times" <?php if (get_option( 'ocwqv_qvppc_icon' ) == "fa fa-times" || empty(get_option( 'ocwqv_qvppc_icon' ))) {echo 'checked="checked"';} ?>>
	                                            <label>
	                                                <i class="fa fa-times" aria-hidden="true"></i>
	                                            </label>
	                                            <input type="radio" name="ocwqv_qvppc_icon" value="fa fa-times-circle-o" <?php if (get_option( 'ocwqv_qvppc_icon' ) == "fa fa-times-circle-o" ) {echo 'checked="checked"';} ?>>
	                                            <label>
	                                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
	                                            </label>
	                                            <input type="radio" name="ocwqv_qvppc_icon" value="fa fa-times-circle" <?php if (get_option( 'ocwqv_qvppc_icon' ) == "fa fa-times-circle" ) {echo 'checked="checked"';} ?>>
	                                            <label>
	                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
	                                            </label>
	                                            <input type="radio" name="ocwqv_qvppc_icon" value="fa fa-window-close" <?php if (get_option( 'ocwqv_qvppc_icon' ) == "fa fa-window-close" ) {echo 'checked="checked"';} ?>>
	                                            <label>
	                                                <i class="fa fa-window-close" aria-hidden="true"></i>
	                                            </label>
	                                            <input type="radio" name="ocwqv_qvppc_icon" value="fa fa-window-close-o" <?php if (get_option( 'ocwqv_qvppc_icon' ) == "fa fa-window-close-o" ) {echo 'checked="checked"';} ?>>
	                                            <label>
	                                                <i class="fa fa-window-close-o" aria-hidden="true"></i>
	                                            </label>
	                                        </td>
	                                    </tr>
                                        <tr>
                                            <th>Quick View Popup Close Icon Color</th>
                                            <td>
                                               <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo get_option( 'ocwqv_qvppc_icon_color', '#ffffff' ); ?>" name="ocwqv_qvppc_icon_color" value="<?php echo get_option( 'ocwqv_qvppc_icon_color', '#ffffff' ); ?>"/> 
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="cover_div">
                                <table class="ocwqv_data_table">
                                            <h2>Quick View Button Style</h2>
                                    <tr>
                                        <th>Button Title</th>
                                        <td>
                                            <input type="text" name="ocwqv_head_title" value="<?php echo get_option( 'ocwqv_head_title', 'Quick View' ); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Font Size</th>
                                        <td>
                                            <input type="number" name="ocwqv_font_size" value="<?php echo get_option( 'ocwqv_font_size', '15' ); ?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Font Color</th>
                                        <td>
                                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo get_option( 'ocwqv_font_clr', '#ffffff' ); ?>" name="ocwqv_font_clr" value="<?php echo get_option( 'ocwqv_font_clr', '#ffffff' ); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Background Color</th>
                                        <td>
                                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo get_option( 'ocwqv_btn_bg_clr', '#000000' ); ?>" name="ocwqv_btn_bg_clr" value="<?php echo get_option( 'ocwqv_btn_bg_clr', '#000000' ); ?>"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Button Position</th>
                                        <td>
                                            <select name="ocwqv_rd_btn_pos">
                                                <option value="after_add_cart" <?php if (get_option( 'ocwqv_rd_btn_pos' ) == "after_add_cart" || empty(get_option( 'ocwqv_rd_btn_pos' ))) {echo 'selected';} ?>>After Add To Cart</option>
                                                <option value="before_add_cart" <?php if (get_option( 'ocwqv_rd_btn_pos' ) == "before_add_cart" ) {echo 'selected';} ?>>Before Add To Cart</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Button Padding</th>
                                        <td>
                                            <input type="text" name="ocwqv_btn_padding" value="<?php echo get_option( 'ocwqv_btn_padding', '8px 10px' ); ?>">
                                            <span>insert value in px(ex. 6px 8px)</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quick View button Icon</th>
                                        <td>
                                            <input type="checkbox" name="ocwqv_qvicon_enable" value="yes" <?php if (get_option( 'ocwqv_qvicon_enable' ) == "yes" || empty(get_option( 'ocwqv_qvicon_enable' ))) {echo 'checked="checked"';} ?>>
                                            <label>Enable Quick View Button Icon</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Select Quick View Button Icon</th>
                                        <td class="ocwqv_icon_choice">
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-plus" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-plus" || empty(get_option( 'ocwqv_qvicon_choice' ))) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-plus-circle" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-plus-circle" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-plus-square-o" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-plus-square-o" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-plus-square-o" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-plus-square" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-plus-square" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-plus-square" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-search-plus" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-search-plus" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-search" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-search" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-search" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-eye" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-eye" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-eye" aria-hidden="true"></i>
                                            </label>
                                            <input type="radio" name="ocwqv_qvicon_choice" value="fa fa-external-link-square" <?php if (get_option( 'ocwqv_qvicon_choice' ) == "fa fa-external-link-square" ) {echo 'checked="checked"';} ?>>
                                            <label>
                                                <i class="fa fa-external-link-square" aria-hidden="true"></i>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Quick View Button Icon Color</th>
                                        <td>
                                            <input type="text" class="color-picker" data-alpha="true" data-default-color="<?php echo get_option( 'ocwqv_qvicon_clr', '#ffffff' ); ?>" name="ocwqv_qvicon_clr" value="<?php echo get_option( 'ocwqv_qvicon_clr', '#ffffff' ); ?>"/>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="cover_div">
                             <h2>Enable Quick View Button on Pages</h2>
                                <div class="ocwqv_cover_div">
                                    <table class="ocwqv_data_table">
                                        <tr>
                                            <th>Enable on Pages</th>
                                            <td class="ocwqv_show_td">
                                                <input type="checkbox" name="ocwqv_shpg_shop" value="yes" <?php if (get_option( 'ocwqv_shpg_shop', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Shop</label>
                                                <input type="checkbox" name="ocwqv_shpg_cat" value="yes" <?php if (get_option( 'ocwqv_shpg_cat', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Category</label>
                                                <input type="checkbox" name="ocwqv_shpg_tag" value="yes" <?php if (get_option( 'ocwqv_shpg_tag', 'yes' ) == "yes" ) { echo 'checked="checked"'; } ?>>
                                                <label>Tag</label>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="cover_div">
                             <h2>Quick View Button Using Shortcode</h2>
                                <div class="ocwqv_cover_div">
                                    <div class="ocwqvscode">
                                        <p>You can create custom quick view button using shortcode, you can add button to any spot of the page or post to allow visitor to see the quick view of any specific product in your shop.</p>

                                        <p><strong>[ocwqv product_id="{product id}" name="{button name}"]</strong></p>
                                        
                                        <p><em>eg. [ocwqv product_id="15" name="Discover Now"] for the product with ID is 15.</em></p>
                                    </div>
                                </div>
                            </div>
                        <input type="hidden" name="action" value="ocwqv_save_option">
                        <input type="submit" value="Save Changes" name="submit" class="button-primary" id="wfc-btn-space">
                    </form>
                </div>
            <?php
        }


        function OCWQV_save_options() {
            if( current_user_can('administrator') ) { 
                if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ocwqv_save_option'){
                    if(!isset( $_POST['ocwqv_nonce_field'] ) || !wp_verify_nonce( $_POST['ocwqv_nonce_field'], 'ocwqv_nonce_action' )) {
                        
                        echo 'Sorry, your nonce did not verify.';
                        exit;

                    } else {

                        if(isset($_REQUEST['ocwqv_mbl_btn']) && !empty($_REQUEST['ocwqv_mbl_btn'])) {
                            $mbl_btn = sanitize_text_field( $_REQUEST['ocwqv_mbl_btn'] );
                        } else {
                            $mbl_btn = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_quk_btn']) && !empty($_REQUEST['ocwqv_quk_btn'])) {
                            $quk_btn = sanitize_text_field( $_REQUEST['ocwqv_quk_btn'] );
                        } else {
                            $quk_btn = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_images']) && !empty($_REQUEST['ocwqv_show_images'])) {
                            $ocwqv_show_images = sanitize_text_field( $_REQUEST['ocwqv_show_images'] );
                        } else {
                            $ocwqv_show_images = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_title']) && !empty($_REQUEST['ocwqv_show_title'])) {
                            $ocwqv_show_title = sanitize_text_field( $_REQUEST['ocwqv_show_title'] );
                        } else {
                            $ocwqv_show_title = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_ratings']) && !empty($_REQUEST['ocwqv_show_ratings'])) {
                            $ocwqv_show_ratings = sanitize_text_field( $_REQUEST['ocwqv_show_ratings'] );
                        } else {
                            $ocwqv_show_ratings = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_price']) && !empty($_REQUEST['ocwqv_show_price'])) {
                            $ocwqv_show_price = sanitize_text_field( $_REQUEST['ocwqv_show_price'] );
                        } else {
                            $ocwqv_show_price = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_description']) && !empty($_REQUEST['ocwqv_show_description'])) {
                            $ocwqv_show_description = sanitize_text_field( $_REQUEST['ocwqv_show_description'] );
                        } else {
                            $ocwqv_show_description = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_atc']) && !empty($_REQUEST['ocwqv_show_atc'])) {
                            $ocwqv_show_atc = sanitize_text_field( $_REQUEST['ocwqv_show_atc'] );
                        } else {
                            $ocwqv_show_atc = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_show_meta']) && !empty($_REQUEST['ocwqv_show_meta'])) {
                            $ocwqv_show_meta = sanitize_text_field( $_REQUEST['ocwqv_show_meta'] );
                        } else {
                            $ocwqv_show_meta = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_viewdetails_btn']) && !empty($_REQUEST['ocwqv_viewdetails_btn'])) {
                            $ocwqv_viewdetails_btn = sanitize_text_field( $_REQUEST['ocwqv_viewdetails_btn'] );
                        } else {
                            $ocwqv_viewdetails_btn = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_ajax_atc']) && !empty($_REQUEST['ocwqv_ajax_atc'])) {
                            $ocwqv_ajax_atc = sanitize_text_field( $_REQUEST['ocwqv_ajax_atc'] );
                        } else {
                            $ocwqv_ajax_atc = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_shpg_shop']) && !empty($_REQUEST['ocwqv_shpg_shop'])) {
                            $ocwqv_shpg_shop = sanitize_text_field( $_REQUEST['ocwqv_shpg_shop'] );
                        } else {
                            $ocwqv_shpg_shop = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_shpg_cat']) && !empty($_REQUEST['ocwqv_shpg_cat'])) {
                            $ocwqv_shpg_cat = sanitize_text_field( $_REQUEST['ocwqv_shpg_cat'] );
                        } else {
                            $ocwqv_shpg_cat = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_shpg_tag']) && !empty($_REQUEST['ocwqv_shpg_tag'])) {
                            $ocwqv_shpg_tag = sanitize_text_field( $_REQUEST['ocwqv_shpg_tag'] );
                        } else {
                            $ocwqv_shpg_tag = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_qvicon_enable']) && !empty($_REQUEST['ocwqv_qvicon_enable'])) {
                            $ocwqv_qvicon_enable = sanitize_text_field( $_REQUEST['ocwqv_qvicon_enable'] );
                        } else {
                            $ocwqv_qvicon_enable = 'no';
                        }

                        if(isset($_REQUEST['ocwqv_lightbox_enable']) && !empty($_REQUEST['ocwqv_lightbox_enable'])) 
                        {
                            $ocwqv_lightbox_enable = sanitize_text_field( $_REQUEST['ocwqv_lightbox_enable'] );
                        } else {
                            $ocwqv_lightbox_enable = 'no';
                        }

                        update_option('ocwqv_mbl_btn', $mbl_btn, 'yes');
                        update_option('ocwqv_quk_btn', $quk_btn, 'yes');
                        update_option('ocwqv_show_images', $ocwqv_show_images, 'yes');
                        update_option('ocwqv_show_title', $ocwqv_show_title, 'yes');
                        update_option('ocwqv_show_ratings', $ocwqv_show_ratings, 'yes');
                        update_option('ocwqv_show_price', $ocwqv_show_price, 'yes');
                        update_option('ocwqv_show_description', $ocwqv_show_description, 'yes');
                        update_option('ocwqv_show_atc', $ocwqv_show_atc, 'yes');
                        update_option('ocwqv_show_meta', $ocwqv_show_meta, 'yes');
                        update_option('ocwqv_viewdetails_btn', $ocwqv_viewdetails_btn, 'yes');
                        update_option('ocwqv_ajax_atc', $ocwqv_ajax_atc, 'yes');
                        update_option('ocwqv_shpg_shop', $ocwqv_shpg_shop, 'yes');
                        update_option('ocwqv_shpg_cat', $ocwqv_shpg_cat, 'yes');
                        update_option('ocwqv_shpg_tag', $ocwqv_shpg_tag, 'yes');
                        update_option('ocwqv_qvicon_enable', $ocwqv_qvicon_enable, 'yes');
                        update_option('ocwqv_lightbox_enable', $ocwqv_lightbox_enable, 'yes');
                        update_option('ocwqv_qvicon_choice', sanitize_text_field( $_REQUEST['ocwqv_qvicon_choice'] ), 'yes');
                        update_option('ocwqv_qw_popup_loader', sanitize_text_field( $_REQUEST['ocwqv_qw_popup_loader'] ), 'yes');
                        update_option('ocwqv_qvppc_icon', sanitize_text_field( $_REQUEST['ocwqv_qvppc_icon'] ), 'yes');
                        update_option('ocwqv_qvppc_icon_color', sanitize_text_field( $_REQUEST['ocwqv_qvppc_icon_color'] ), 'yes');
                        update_option('ocwqv_qvicon_clr',  sanitize_text_field( $_REQUEST['ocwqv_qvicon_clr'] ), 'yes');
                        update_option('ocwqv_head_title', sanitize_text_field( $_REQUEST['ocwqv_head_title'] ), 'yes');
                        update_option('ocwqv_font_clr',  sanitize_text_field( $_REQUEST['ocwqv_font_clr'] ), 'yes');
                        update_option('ocwqv_font_size', sanitize_text_field( $_REQUEST['ocwqv_font_size'] ), 'yes');
                        update_option('ocwqv_btn_bg_clr',sanitize_text_field( $_REQUEST['ocwqv_btn_bg_clr'] ), 'yes');
                        update_option('ocwqv_rd_btn_pos', sanitize_text_field( $_REQUEST['ocwqv_rd_btn_pos'] ),'yes');
                        update_option('ocwqv_btn_padding',sanitize_text_field( $_REQUEST['ocwqv_btn_padding']),'yes');
                        update_option('ocwqv_qw_popup_bg',sanitize_text_field( $_REQUEST['ocwqv_qw_popup_bg']),'yes');
                    }
                }
            }
        }


        function init() {
            add_action( 'admin_menu',  array($this, 'OCWQV_submenu_page'));
            add_action( 'init',  array($this, 'OCWQV_save_options'));
        }


        public static function OCWQV_instance() {
            if (!isset(self::$OCWQV_instance)) {
                self::$OCWQV_instance = new self();
                self::$OCWQV_instance->init();
            }
            return self::$OCWQV_instance;
        }
    }
    OCWQV_admin_menu::OCWQV_instance();
}