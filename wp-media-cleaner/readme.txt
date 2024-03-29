=== WP Media Cleaner ===
Contributors: TigrouMeow
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=H2S7S3G4XMJ6J
Tags: management, admin, file, files, images, image, media, libary, upload, clean, cleaning
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 2.0.2

Help you cleaning your Uploads Directory and your Media Library.

== Description ==

Help you cleaning your Uploads Directory and your Media Library. It checks if:

- the physical file is linked to a media
- the media is used in a post
- the media is used in a post meta
- the media is present in a WP gallery
- a retina image is orphan

If not, it will be added to a specific dashboard and you can trash them from there. After more testing, you can trash them definitely. You can also choose to "ignore" specific files.

This plugin deletes files so be careful to backup your files and databases before using it, especially the first time. 

It has been tested with WP Retina 2x and WPML.

Languages: English, French.

== Installation ==

1. Upload `wp-media-cleaner` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go in Media -> Clean

== Upgrade Notice ==

Replace all the files. Nothing else to do.

== Frequently Asked Questions ==

= Is it safe? =
I am not sure how a plugin that deletes files could be 100% safe ;) I did my best (and will improve it in every way I can) but it's impossible to cover all the cases. I ran it on a few big websites and it performs very well. Make a backup (database + uploads directory) then run it.

= What is 'Reset' doing exactly? =
It re-creates the WP Media Cleaner table in the database. You will need to re-run the scan after this.

= I donated, how can I get rid of the donation button? =
Of course. I don't like to see too many of those buttons neither ;) You can disable the donation buttons from all my plugins by adding this to your wp-config.php: `define('WP_HIDE_DONATION_BUTTONS', true);`

= Can I contact you? =
Please contact me through my website <a href='http://www.totorotimes.com'>Totoro Times</a>. Thanks!

== Screenshots ==

1. Media -> Clean

== Changelog ==

= 2.0.2 =
* Works with WP 4.

= 2.0.0 =
* Gallery support.

= 1.9.4 =
* I did something but not sure what.
* Ah yeah, I got married :)

= 1.9.2 =
* Fix: IGNORE function was... ignored by the scanning process.

= 1.9.0 =
* Add: thumbnails.
* Add: IGNORE function.
* Change: cosmetic changes.

= 1.8.0 =
* Add: now detects the custom header and custom background.
* Change: the CSS was updated to fit the new Admin theme.

= 1.7.0 =
* Change: the MEDIA files are now going to the trash but the MEDIA reference in the DB is still removed permanently.

= 1.6.0 =
* Stable release.

= 1.4.2 =
* Change: Readme.txt.

= 1.4.0 =
* Add: check the meta properties.
* Add: check the 'featured image' properties.
* Fix: keep the trash information when a new scan is started.
* Fix: remove the DB on uninstall, not on desactivate.

= 1.2.2 =
* Add: progress %.
* Fix: issues with apostrophes in filenames.
* Change: UI cleaning.

= 1.2.0 =
* Add: options (scan files / scan media).
* Fix: mkdir issues.
* Change: operations are buffered by 5 (faster).

= 0.1.0 =
* First release.

== Wishlist ==

Do you have suggestions? Feel free to contact me at <a href='http://www.totorotimes.com'>Totoro Times</a>.