<?php
/*
Plugin Name: Custom Post Order
Plugin URI: http://blogs.ubc.ca/support/plugins/custom-post-order/
Description: This plugin enables users to customize the order in which posts are being displayed anywhere on their pages: by date ascending or descending, by title, etc. Please note: once the order has been set, the post display order will be the same anywhere in the blog; the current version does not support different display orders for different categories/pages within your blog.
Version: 1.0.2
Author: Cosmin Atanasiu / OLT UBC
Author URI: http://olt.ubc.ca
*/
 
/*
== Installation ==
 
1. Download the custompostorder.zip file to a directory of your choice(preferably the wp-content/plugins folder)
2. Unzip the custompostorder.zip file into the wordpress plugins directory: 'wp-content/plugins/'
3. Activate the plugin through the 'Plugins' menu in WordPress
4. To set the order access the Wordpress Manage->Custom Post Order link, for 2.6 and Tools->Custom Post Order link, for 2.7
*/
 
/*
/--------------------------------------------------------------------\
|                                                                    |
| License: GPL                                                       |
|                                                                    |
| Custom Post Order - brief description                              |
| Copyright (C) 2008, OLT, http://olt.ubc.ca                         |
| All rights reserved.                                               |
|                                                                    |
| This program is free software; you can redistribute it and/or      |
| modify it under the terms of the GNU General Public License        |
| as published by the Free Software Foundation; either version 2     |
| of the License, or (at your option) any later version.             |
|                                                                    |
| This program is distributed in the hope that it will be useful,    |
| but WITHOUT ANY WARRANTY; without even the implied warranty of     |
| MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the      |
| GNU General Public License for more details.                       |
|                                                                    |
| You should have received a copy of the GNU General Public License  |
| along with this program; if not, write to the                      |
| Free Software Foundation, Inc.                                     |
| 51 Franklin Street, Fifth Floor                                    |
| Boston, MA  02110-1301, USA                                        |   
|                                                                    |
\--------------------------------------------------------------------/
*/

/**
 * Creation of the Custom Post Order
 * This class should host all the functionality that the plugin requires.
 */
/*
 * first get the options necessary to properly display the plugin
 */



if ( !class_exists( "CustomPostOrder" ) ) {
    add_action ( 'admin_menu', array ( 'CustomPostOrder', 'CustomPostOrder_options' ) );
    global $post;
    
    class CustomPostOrder {
	
        /**
         * Global Class Variables
         */
        
        
        var $optionsName = "CustomPostOrderOptions";
        var $folder = '/wp-content/plugins/custompostorder/';
        var $version = "1.0";
    
	
	
        /**
	 * CustomPostOrder plugin options page
	 */
	function CustomPostOrder_options ( ) {
		if ( function_exists ( 'add_management_page' ) ) 
		{ 
		    add_management_page ( 'Custom Post Order', 'Custom Post Order', 9, 
                            dirname ( __FILE__ ) .'/custom-post-order-admin-functions.php' );
		}
	}

	function custom_posts_order( $orderby )
        {
            $category_checked = false;
	    $settings = get_option ( "CustomPostOrder-settings" );
            $cats = $settings['applyArray'];
            if ( $settings['applyTo'] == 'all')
                return $settings['orderElement']." ".$settings['orderType'];
            else {
                if($cats!=''){
                    foreach ( $cats as $cat ):
                        if ( is_category ( $cat ) ) {
                            $category_checked = true;
                            break;
                        }
                    endforeach;
                    if ( $category_checked ) {
                        return $settings['orderElement']." ".$settings['orderType'];
                    }
                    else
                        return 'post_date DESC';
                }
            }
            
	}
	
    } // End Class CustomPostOrderPluginSeries

} 

/**
 * Initialize the admin panel function 
 */

if (class_exists("CustomPostOrder")) {

    $CustomPostOrderInstance = new CustomPostOrder();

}

/**
  * Set Actions, Shortcodes and Filters
  */
if (isset($CustomPostOrderInstance))
    add_filter ( 'posts_orderby', array ( &$CustomPostOrderInstance, 'custom_posts_order' ) );

?>
