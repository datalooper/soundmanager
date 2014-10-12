<?php
/*
Plugin Name: WP Admin UI Guide
Plugin URI: http://www.wp-appstore.com/wp-admin-ui-reference-guide/
Description: Reference guide for all admin UI elements in WordPress admin. Must-have for all plugins developers.
Version: 0.5.2
Author: Eugene Pyvovarov
Author URI: http://www.ultimateblogsecurity.com/
License: GPL2

Copyright 2010  Eugene Pyvovarov  (email : bsn.dev@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

https://github.com/blog/760-the-tree-slider
http://www.onextrapixel.com/2009/07/01/how-to-design-and-style-your-wordpress-plugin-admin-panel/
http://www.code-styling.de/english/how-to-use-wordpress-metaboxes-at-own-plugins
*/
    global $wp_version;
    function wp_admin_widgets_admin_init()
    {
        /* Register our script. */
        wp_register_script('wp_admin_widgets_script', WP_PLUGIN_URL . '/js/script.js');
        wp_enqueue_script('jquery');
        wp_enqueue_script('admin-widgets');
        wp_enqueue_script('link');
        // wp_enqueue_script('xfn');
         
    }
    
    function wp_admin_widgets_admin_menu()
    {
        /* Register our plugin page */
        $page = add_submenu_page( 'tools.php', 
                                  __('WP Admin UI Guide', 'wp_admin_widgets'), 
                                  __('WP Admin UI Guide', 'wp_admin_widgets'), 7,  __FILE__, 
                                  'wp_admin_widgets_manage_menu');
   
        /* Using registered $page handle to hook script load */
        add_action('admin_print_scripts-' . $page, 'wp_admin_widgets_admin_styles');
    }

    function wp_admin_widgets_admin_styles()
    {
        /*
         * It will be called only on your plugin admin page, enqueue our script here
         */
    }
    
    function wp_admin_widgets_manage_menu()
    {
        ?>
        <style>
        pre {
            padding:10px;
            background:#f3f3f3;
            margin-top:10px;
        }
        #icon-widgets-demo {
            background: transparent url(<?php echo plugins_url( 'images/book_open.png', __FILE__ ); ?>) no-repeat;
        }
        </style>
        <div class="wrap">
            <?php screen_icon( 'widgets-demo' );?>
            <h2>WordPress Admin UI Reference Guide
            <!-- <span style="position:absolute;padding-left:25px;">
            <a href="http://www.facebook.com/pages/Ultimate-Blog-Security/141398339213582" target="_blank"><img src="<?php echo plugins_url( 'img/facebook.png', __FILE__ ); ?>" alt="" /></a>
            <a href="http://twitter.com/BlogSecure" target="_blank"><img src="<?php echo plugins_url( 'img/twitter.png', __FILE__ ); ?>" alt="" /></a>
            <a href="http://ultimateblogsecurity.posterous.com/" target="_blank"><img src="<?php echo plugins_url( 'img/rss.png', __FILE__ ); ?>" alt="" /></a>
            </span> -->
            </h2>
            <div style="float:left;width:450px;">
            <h3>Widgets</h3><a name="#top"></a>
            <ul>
                <li><a href="#title">Title &amp; Icons</a></li>
                <li><a href="#block">Block Widget</a></li>
                <li><a href="#block-draggable">Draggable Block Widget</a></li>
                <li><a href="#table">Tables(data, logs, quick edit, search)</a></li>
                <li>TBD: Pagers(different types)</li>
                <li><a href="#block-tabs">Tabs(small, big)</a></li>
                <li>TBD: Forms(input elements, html5 elements, formset)</li>
                <li>TBD: Buttons, links, images</li>
                <li>TBD: Sliders(text, photos)</li>
                <li>TBD: Lightbox window(like in wordpress itself)</a></li>
            </ul>
            </div>
            <div>
            <h3>For developers</h3>
            <ul>
                <li><a href="#">Soon: Fork wp-admin-widgets on github</a></li>
                <li><a href="#">Soon: Design your plugin using online tool</a></li>
            </ul>
            </div>
            <div class="clear"></div>
            <h3>Title &amp; Icons<a name="title"></a><a href="#top" style="font-size:13px;margin-left:10px;">&uarr; Back</a></h3>
            <p>
                <h2>Header</h2>
                <pre><?php echo htmlentities('<h2>Header</h2>')?></pre>
                <h3>Header</h3>
                <pre><?php echo htmlentities('<h3>Header</h3>')?></pre>
                <h4>Header</h4>
                <pre><?php echo htmlentities('<h4>Header</h4>')?></pre>
                <h5>Header</h5>
                <pre><?php echo htmlentities('<h5>Header</h5>')?></pre>
                <p>Wordpress has some builtin page icons which you can use too</p>
                <?php screen_icon( 'index' );?>
                <?php screen_icon( 'edit' );?>
                <?php screen_icon( 'upload' );?>
                <?php screen_icon( 'link' );?>
                <?php screen_icon( 'page' );?>
                <?php screen_icon( 'edit-comments' );?>
                <?php screen_icon( 'themes' );?>
                <?php screen_icon( 'plugins' );?>
                <?php screen_icon( 'users' );?>
                <?php screen_icon( 'tools' );?>
                <?php screen_icon( 'options-general' );?>
                <?php screen_icon( 'ms-admin' );?>
                
                <div class="clear"></div>
                
                <pre><?php echo htmlentities("screen_icon( 'index' );\r\nscreen_icon( 'edit' );\r\nscreen_icon( 'upload' );
screen_icon( 'link' );\r\nscreen_icon( 'page' );\r\nscreen_icon( 'edit-comments' );\r\nscreen_icon( 'themes' );
screen_icon( 'plugins' );\r\nscreen_icon( 'users' );\r\nscreen_icon( 'tools' );\r\nscreen_icon( 'options-general' );
screen_icon( 'ms-admin' );")?>
                </pre>
                <p>You can also have your own icon, just put 32x32 image(better to use greyscale) into the plugin folder and define the class "icon-sometitle" for 
                it.<br/> Then just insert it with title "sometitle" &mdash; and you're done.</p>
                <?php screen_icon( 'widgets-demo' );?>
                <div style="clear:both;"></div>
                <pre><?php echo htmlentities("<style>\r\n#icon-widgets-demo {
    background: transparent url(<?php echo plugins_url( 'images/book_open.png', __FILE__ ); ?>) no-repeat;\r\n}\r\n</style>
screen_icon( 'widgets-demo' );")?>
                </pre>
            </p>
            <div class="clear"></div>
            <h3>Block Widget<a name="block"></a><a href="#top" style="font-size:13px;margin-left:10px;">&uarr; Back</a></h3>
            <p>
                To be able to insert blog widgets into your plugins you don't need any additional styles.<br>
                Just insert the same structure WordPress uses for it's own pages.<br>
                Here's how you can use simple widgets without drag&amp;drop.
            </p>
            <div id="poststuff" class="metabox-holder">
                <div id="linksubmitdiv" class="postbox " style="float:left;width:250px;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span>Save</span></h3>
                    <div class="inside">
                        <p>This is just sample text.</p>
                    </div>
                </div>
                <div id="linksubmitdiv" class="postbox " style="float:left;width:250px;margin-left:25px;">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span>Save</span></h3>
                    <div class="inside">
                        <div id="major-publishing-actions">
                            <div id="publishing-action">
                                <input name="save" type="submit" class="button-primary" id="publish" value="Add Link">
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>              
            </div>
            <div class="clear"></div>
            <pre>
                <?php echo htmlentities('
<div id="poststuff" class="metabox-holder">
    <div id="linksubmitdiv" class="postbox " style="float:left;width:250px;">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span>Save</span></h3>
        <div class="inside">
            <p>This is just sample text.</p>
        </div>
    </div>
    <div id="linksubmitdiv" class="postbox " style="float:left;width:250px;margin-left:25px;">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span>Save</span></h3>
        <div class="inside">
            <div id="major-publishing-actions">
                <div id="publishing-action">
                    <input name="save" type="submit" class="button-primary" id="publish" value="Add Link">
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>              
</div>')?>
            </pre>
            <p>Now if you wanna put some big widget in the center and kind of sidebars on right side &mdash; here is example for 
            that too<br>
			Difference with previous example is that you need to use <b>.has-right-sidebar</b> class and to add div with class
            <b>.inner-sidebar</b> and then put sidebar widgets inside it.</p>
            <div id="poststuff" class="metabox-holder has-right-sidebar">

            <div id="side-info-column" class="inner-sidebar">
                <div id="linksubmitdiv" class="postbox " style="">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span>Test sidebar block 1</span></h3>
                    <div class="inside">
                        <p>This is just sample text.</p>
                    </div>
                </div>
                <div id="linksubmitdiv" class="postbox " style="">
                    <div class="handlediv" title="Click to toggle"><br></div>
                    <h3 class="hndle"><span>Test sidebar block 2</span></h3>
                    <div class="inside">
                        <div id="major-publishing-actions">
                            <div id="publishing-action">
                                <input name="save" type="submit" class="button-primary" id="publish" value="Add Link">
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="post-body">
                <div id="post-body-content">
                    <div id="namediv" class="stuffbox">
                        <h3><label for="link_name">Test block 1</label></h3>
                        <div class="inside">
                            <input type="text" name="sample_input" size="20"  />
                            <p>Sample text here under the input</p>
                        </div>
                    </div>
                    <div id="addressdiv" class="stuffbox">
                        <h3><label for="link_url">Test block 2</label></h3>
                        <div class="inside">
                            <p>Another text here too</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="clear"></div>
            <pre><?php echo htmlentities('
<div id="poststuff" class="metabox-holder has-right-sidebar">
<div id="side-info-column" class="inner-sidebar">
    <div id="linksubmitdiv" class="postbox " style="">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span>Test sidebar block 1</span></h3>
        <div class="inside">
            <p>This is just sample text.</p>
        </div>
    </div>
    <div id="linksubmitdiv" class="postbox " style="">
        <div class="handlediv" title="Click to toggle"><br></div>
        <h3 class="hndle"><span>Test sidebar block 2</span></h3>
        <div class="inside">
            <div id="major-publishing-actions">
                <div id="publishing-action">
                    <input name="save" type="submit" class="button-primary" id="publish" value="Add Link">
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>
<div id="post-body">
    <div id="post-body-content">
        <div id="namediv" class="stuffbox">
            <h3><label for="link_name">Test block 1</label></h3>
            <div class="inside">
                <input type="text" name="sample_input" size="20"  />
                <p>Sample text here under the input</p>
            </div>
        </div>
        <div id="addressdiv" class="stuffbox">
            <h3><label for="link_url">Test block 2</label></h3>
            <div class="inside">
                <p>Another text here too</p>
            </div>
        </div>
    </div>
</div>
</div>');?></pre>
	<div class="clear"></div>
	<h3>Draggable Block Widget<a name="block-draggable"></a><a href="#top" style="font-size:13px;margin-left:10px;">&uarr; Back</a></h3>
	<div id="poststuff" class="metabox-holder" style="width:250px;">
		<div class="meta-box-sortables ui-sortable">
        <div id="linksubmitdiv" class="postbox " style="margin:10px 0;">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Save</span></h3>
            <div class="inside">
                <p>This is just sample text.</p>
            </div>
        </div>
        <div id="linksubmitdiv" class="postbox " style="margin:10px 0;">
            <div class="handlediv" title="Click to toggle"><br></div>
            <h3 class="hndle"><span>Save</span></h3>
            <div class="inside">
                <div id="major-publishing-actions">
                    <div id="publishing-action">
                        <input name="save" type="submit" class="button-primary" id="publish" value="Add Link">
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>     
		</div>         
    </div>
	<div class="clear"></div>
	<h3>Tables<a name="table"></a><a href="#top" style="font-size:13px;margin-left:10px;">&uarr; Back</a></h3>
	<p>Table data is one of the most important parts in WordPress admin. Since version 3.1.0 you can use class WP_List_Table
		to display table with data, pagination, search, sortable rows, actions or bulk actions. For previous versions you can use
		plain html table to display data.
	</p>
	<h4>Plain HTML table</h4>
    <div class="clear"></div>
	<table class="widefat">
	<thead>
	    <tr>
	        <th>RegId</th>
	        <th>Name</th>
	        <th>Email</th>
	    </tr>
	</thead>
	<tfoot>
	    <tr>
	    <th>RegId</th>
	    <th>Name</th>
	    <th>Email</th>
	    </tr>
	</tfoot>
	<tbody>
       <tr>
         <td>1</td>
         <td>test</td>
         <td>simple text</td>
       </tr>
       <tr class="alternate">
         <td>2</td>
         <td>another</td>
         <td>more text here</td>
       </tr>
       <tr>
         <td>3</td>
         <td>quess what?</td>
         <td>more text here</td>
       </tr>
	</tbody>
	</table>
	<div class="clear"></div>
	<pre><?php echo htmlentities('
<table class="widefat">
<thead>
    <tr>
        <th>RegId</th>
        <th>Name</th>
        <th>Email</th>
    </tr>
</thead>
<tfoot>
    <tr>
    <th>RegId</th>
    <th>Name</th>
    <th>Email</th>
    </tr>
</tfoot>
<tbody>
   <tr>
     <td>1</td>
     <td>test</td>
     <td>simple text</td>
   </tr>
   <tr class="alternate">
     <td>2</td>
     <td>another</td>
     <td>more text here</td>
   </tr>
   <tr>
     <td>3</td>
     <td>quess what?</td>
     <td>more text here</td>
   </tr>
</tbody>
</table>');?></pre>
<div class="clear"></div>
<p><em>More info about using <b>WP_List_Table</b> class will come soon.</em></p>
<h3>Tabs(small, big)<a name="block-tabs"></a><a href="#top" style="font-size:13px;margin-left:10px;">&uarr; Back</a></h3>

<h4>You can use really big tabs:</h4>
<h2 class="nav-tab-wrapper">
    <a href="#" class="nav-tab nav-tab-active">Manage Themes</a>
    <a href="#" class="nav-tab">Install Themes</a>
</h2>
    <div class="clear"></div>
	<pre><?php echo htmlentities('<h2 class="nav-tab-wrapper">
    <a href="#" class="nav-tab nav-tab-active">Manage Themes</a>
    <a href="#" class="nav-tab">Install Themes</a>
</h2>');?></pre>
    <div class="clear"></div>
<h4>A bit smaller:</h4>
<style>
    h3.nav-tab-wrapper .nav-tab {
        padding-top:7px;
    }
</style>
<h3 class="nav-tab-wrapper">
    <a href="#" class="nav-tab">Manage Themes</a>
    <a href="#" class="nav-tab nav-tab-active">Install Themes</a>
</h3>
    <div class="clear"></div>
	<pre><?php echo htmlentities('<style>
    h3.nav-tab-wrapper .nav-tab {
        padding-top:7px;
    }
</style>
<h3 class="nav-tab-wrapper">
    <a href="#" class="nav-tab">Manage Themes</a>
    <a href="#" class="nav-tab nav-tab-active">Install Themes</a>
</h3>');?></pre>
    <div class="clear"></div>
<h4>Or just inline set of links:</h4>
    <ul class="subsubsub">
    	<li class="all"><a href="#">All <span class="count">(11)</span></a> |</li>
    	<li class="active"><a href="#">Active <span class="count">(6)</span></a> |</li>
    	<li class="inactive"><a href="#" class="current">Inactive <span class="count">(5)</span></a> |</li>
    	<li class="upgrade"><a href="#">Update Available <span class="count">(4)</span></a></li>
    </ul>
    <div class="clear"></div>
	<pre><?php echo htmlentities('<ul class="subsubsub">
	<li class="all"><a href="#">All <span class="count">(11)</span></a> |</li>
	<li class="active"><a href="#">Active <span class="count">(6)</span></a> |</li>
	<li class="inactive"><a href="#" class="current">Inactive <span class="count">(5)</span></a> |</li>
	<li class="upgrade"><a href="#">Update Available <span class="count">(4)</span></a></li>
</ul>');?></pre>
    <div class="clear"></div>
    <?php
    }
    add_action('admin_init', 'wp_admin_widgets_admin_init');
    add_action('admin_menu', 'wp_admin_widgets_admin_menu');
?>
