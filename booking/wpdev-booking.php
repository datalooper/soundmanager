<?php
/*
Plugin Name: Booking Calendar
Plugin URI: http://wpbookingcalendar.com/demo/
Description: Online reservation and availability checking service for your site.
Version: 5.2
Author: wpdevelop
Author URI: http://wpbookingcalendar.com/
Tested WordPress Versions: 3.3 - 4.0
*/

/*  Copyright 2009 - 2014  www.wpbookingcalendar.com  (email: info@wpbookingcalendar.com),

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
*/

/*
-----------------------------------------------
Change Log and Features for Future Releases :
-----------------------------------------------
 * New/OLD Files:
 * =====================================
 * ../js/admin.js
 * ../js/client.js
 *
 * ../lib/wpbc-class-settings.php
 * ../lib/wpbc-gcal.php
 * ../lib/wpbc-gcal-class.php
 * ../lib/wpbc-cron.php
 *
 * ../inc/wpbc-br-table-for-settings.php
 * ../inc/sync/index.php
 * ../inc/sync/wpbc-sync-gcal-api.php
 * ../inc/sync/wpbc-sync-gcal-feed.php
 * Remove:
 * - ../js/wpdev.bk.js
 * ====================================
*/
    
    // Exit if accessed directly
    if ( ! defined( 'ABSPATH' ) ) die('<h3>Direct access to this file do not allow!</h3>');

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // PRIMARY URL CONSTANTS                        //////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    // ..\home\siteurl\www\wp-content\plugins\plugin-name\wpdev-booking.php
    if ( ! defined( 'WPDEV_BK_FILE' ) )             define( 'WPDEV_BK_FILE', __FILE__ ); 
    
    // wpdev-booking.php
    if ( ! defined('WPDEV_BK_PLUGIN_FILENAME' ) )   define('WPDEV_BK_PLUGIN_FILENAME', basename( __FILE__ ) );                     

    // plugin-name    
    if ( ! defined('WPDEV_BK_PLUGIN_DIRNAME' ) )    define('WPDEV_BK_PLUGIN_DIRNAME',  plugin_basename( dirname( __FILE__ ) )  );  
    
    // ..\home\siteurl\www\wp-content\plugins\plugin-name
    if ( ! defined('WPDEV_BK_PLUGIN_DIR' ) )        define('WPDEV_BK_PLUGIN_DIR', untrailingslashit( plugin_dir_path( WPDEV_BK_FILE ) )  );
    
    // http: //website.com/wp-content/plugins/plugin-name
    if ( ! defined('WPDEV_BK_PLUGIN_URL' ) )        define('WPDEV_BK_PLUGIN_URL', untrailingslashit( plugins_url( '', WPDEV_BK_FILE ) )  );     
          
    require_once WPDEV_BK_PLUGIN_DIR . '/lib/wpbc.php'; 
?>