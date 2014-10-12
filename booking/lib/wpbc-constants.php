<?php
/**
 * @version 1.0
 * @package Booking Calendar 
 * @subpackage Define Constants
 * @category Bookings
 * 
 * @author wpdevelop
 * @link http://wpbookingcalendar.com/
 * @email info@wpbookingcalendar.com
 *
 * @modified 2014.05.17
 */

if ( ! defined( 'ABSPATH' ) ) exit;                                             // Exit if accessed directly

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   USERS  CONFIGURABLE  CONSTANTS           //////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!defined('WP_BK_SHOW_INFO_IN_FORM'))                define('WP_BK_SHOW_INFO_IN_FORM', false );          // This feature can impact to the performace
if (!defined('WP_BK_SHOW_BOOKING_NOTES'))               define('WP_BK_SHOW_BOOKING_NOTES', false );         // Set notes of the specific booking visible by default.
if (!defined('WP_BK_CUSTOM_FORMS_FOR_REGULAR_USERS'))   define('WP_BK_CUSTOM_FORMS_FOR_REGULAR_USERS', false );

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   SYSTEM  CONSTANTS                        //////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (!defined('WP_BK_VERSION_NUM'))      define('WP_BK_VERSION_NUM',     '5.2' );
if (!defined('WP_BK_MINOR_UPDATE'))     define('WP_BK_MINOR_UPDATE',    ! true );    
if (!defined('IS_USE_WPDEV_BK_CACHE'))  define('IS_USE_WPDEV_BK_CACHE', true );    
if (!defined('WP_BK_DEBUG_MODE'))       define('WP_BK_DEBUG_MODE',      false );
if (!defined('WP_BK_MIN'))              define('WP_BK_MIN',             false );//TODO: Finish  with  this contstant, right now its not working correctly with TRUE status
if (!defined('WP_BK_RESPONSE'))         define('WP_BK_RESPONSE',        false );
?>