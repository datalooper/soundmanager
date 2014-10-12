=== Bookings ===
Contributors: zingiri
Donate link: http://www.zingiri.com/donations
Tags: booking, schedule, scheduler, appointment, reservation, appointment, availability, availability calendar, Booking calendar, booking form, calendar, event calendar, events, reservation plugin, scheduling, online reservation, appointment scheduling
Requires at least: 3.0
Tested up to: 4.0
Stable tag: 4.3.0

Bookings is a powerful reservations scheduler.

Whether you're running a Beauty salon, Spa, Hairdresser, Massage therapy, Acupuncture or providing hotel rooms, visitors to your site will be able to check availability of your service and make online bookings.

== Description ==

This WordPress plugin allows you to provide online booking services for your site.

* Blackout times are easy to add and manage to restrict reservations.
* Reservation minimum and maximum time limits can be set on a per-resource basis.
* Administrator has power to add and manage an unlimited number of resources. All which can be toggled active and inactive at any point.
* Administrator has control over all reservations and can browse, modify and delete any reservation in the system.
* Administrators can search through the reservation database with a very flexible search tool. Search results can be viewed as HTML, plain-text, XML or CSV.
* Calendars can be viewed in a day/week/month layout.
* Reservations can be set to be approved or not
* Supports multiple languages: English (US & GB), German, French, Spanish, Italian, Hungarian, Dutch, Finnish, Swedish, Turkish, Arabic, Bulgarian, Chinese (Traditional & Simplified), Czech, Danish, Greek, Japanese, Korean, Polish, Portuguese, Slovak and Slovenian.
* Community support via our [Forums](http://forums.zingiri.net "Forums") 
* Limited to 1 schedule and 25 bookings per month

The Pro and Expert versions of the plugin additionaly offer:

* Unlimited bookings
* Unlimited schedules
* Integration of payment gateways such as Paypal etc 
* Products & services
* Customization of the booking form with custom fields
* Mobile syncing with your iPhone, iPad, Android device and more
* Possibility to edit the thank you text on the confirmation page
* Possibility to edit the confirmation emails 
* Multiple configuration options: send admin confirmation email, currency, etc
* Export reservations to your favorite calendar (Outlook, iCal, etc) from the admin back-end or your confirmation email
* Possibility to search reservations by reservation ID
* Possibility to define your own time spans
* Priority support via our [Helpdesk](http://www.zingiri.com/portal "Helpdesk") and by phone

Note: Bookings uses web services stored on Zingiri's servers, read more in the plugin's FAQ about what that means.

== Installation ==

1. Upload the `bookings` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Include the code [bookings] in any page to display the bookings form. There are differrent options for formatting the bookings form that are documented on [our site](http://www.zingiri.com/bookings#usage "our site").

Please visit [Zingiri](http://wiki.zingiri.com/index.php?title=Bookings:Main "Zingiri") for more information and support.

== Frequently Asked Questions ==

= This plugin uses web services, what exactly does that mean? =
Web services are simple way of delivering software solutions. Basically it means that the software & data is hosted on our secure servers and that you can access it from anywhere in the world. 
No need to worry about backing up your data, managing systems, we do it for you.

= What about data privacy? =
Bookings uses web services stored on Zingiri's servers. In doing so, personal data is collected and stored on our servers. 
This data includes amongst others your admin email address as this is used, together with the API key as a unique identifier for your account on Zingiri's servers. 
We have a very strict [privacy policy](http://www.zingiri.com/privacy-policy/ "privacy policy") as well as [terms & conditions](http://www.zingiri.com/terms/ "terms & conditions") governing data stored on our servers.

Please visit the [Zingiri Support Forums](http://forums.zingiri.net/forumdisplay.php?fid=60 "Zingiri Support Forum") or download our [Documentation](http://www.zingiri.com/portal/?ccce=downloads&action=displaycat&catid=6 "Documentation") for more information and support.

== Screenshots ==

Screenshots are available [here](http://www.zingiri.com/plugins-and-addons/bookings/ "screenshots").

== Changelog ==

= 4.3.0 =
* Compatibility with WP version 4.0
* Load CSS and Javascript files from CDN for improved performance

= 4.2.1 =
* Ajax calendar now automatically detects whether to display a schedule calendar or predefined dates & times
* Fixed issue with calendar sync initialisation
* Verified compatibility with version 3.9.1

= 4.2.0 =
* Rearranged css files
* Added product to reservation view
* Added checkout form content to reservation view
* New ajax look and feel for base templates (beta, new subscriptions only)

= 4.1.0 =
* New ajaxified front-end
* New ajax look and feel for template 'products+resources'

= 4.0.1 =
* Changed look & feel of schedules list
* Changed look & feel of reservations list
* Combined list and approve reservations list
* Combined schedule calendar and blackout calendar in one overview
* Various fixes

= 4.0.0 =
* Major refactoring

= 3.5.7 =
* Pre-emptive fix for loading ajax content

= 3.5.6 =
* Adjustments to css

= 3.5.5 =
* Fixed issue with display of non UTF-8 characters in UTF-8 output
* Fixed issue with deleting of schedules not working in certain cases

= 3.5.4 =
* Disabled sending of emails to user and to admin on user creation
* Fixed issue with payment buttons when not using permalinks

= 3.5.3 =
* Fixed issue with shownames not working
* Fixed issue with adminEmail config option initialisation when accessing via DAV server
* Removed 'Predefined set of dates and times'

= 3.5.2 =
* Fixed issue with updating Paypal standard gateway
* Added manual payment gateway
* Added Authorize.net Server Integration Method (SIM) payment gateway
* Edited Czech language file

= 3.5.1 =
* Fixed an activation issue

= 3.5.0 =
* Major change to checkout process so that payment is processed before booking is confirmed
* Adjusted admin theme
* Implementation of new payments gateway framework
* Added Paypal Express payment gateway

= 3.4.5 =
* Fixed issue with month dropdown on some templates

= 3.4.4 =
* Added display of reservation quantity when viewing a reservation and the system is configured to allow multiple quantity reservations

= 3.4.3 =
* New yearly calendar schedule view in back-end (for full day schedules only)
* Added month/year dropdown in hotel2 template
* Fixed issues with calendar popup on hotel1 template
* Fixed issue with calculation of pricing if start and end date overlap 2 seasons

= 3.4.2 =
* Verified compatibility with Wordpress version 3.7.1
* Added PHP to list of currencies
* Added new dropdown1 calendar template

= 3.4.1 =
* Fixed issue where booking cart doesn't work when using template rp2 and allowing multiple slots and selection of quantity
* Fixed issue with changing usernames ane emails
* Fixed issue with length of calculated availability period when using predefined dates and times
* Added support for Wordpress versions that don't have the 'wp_enqueue_media' function yet

= 3.4.0 =
* Added booking cart feature (experimental)
* Fixed issue with overlay opened when clicking on 'recurring' button in products and services not working

= 3.3.2 =
* Adjustments to hotel3 template
* New api function
* Fixed issue with display of availability in schedule template
* Fixed issue with reminders not being sent
* Fixed issue with encoding of French language file

= 3.3.1 =
* Added new option to set a Session expiry message
* Fixed issue with Norwegian not appearing correctly in drop down of languages when creating a template
* Fixed issue with conversion of durations to hours/minutes and vice versa
* Fixed issues with price calculation when using shopping cart
* Improved display of reservation summary when viewing a reservation
* Fixed issue with displaying availability when using products and time between bookings
* Minor enhancements to admin look and feel
* Fixed compatibility issue with media buttons in product & services following Wordpress 3.6 upgrade 
* Improved French translations

= 3.3.0 =
* Fixed issue with move one day forward/back links not working on calendar
* Added Norwegian to language drop down in templates

= 3.2.3 =
* Fixed issue with last date of month availability not displaying when using predefined dates and times
* Fixed issue with availability display if using future dates in predefined dates and times setup
* Added freeDayBoxStyle class to identify calendar days with availability
* Added new 'event1' calendar template to display list of upcoming dates and times
* Added Norwegian translation 

= 3.2.2 =
* Verified compatibility with Wordpress v3.6
* Added temporary disabling of media buttons in product & services description due to issue in Wordpress v3.6

= 3.2.1 =
* Fixed issue with resource min_notice_time field not being created for new installations

= 3.2.0 =
* Added possibility to create products with predefined dates and times
* Implemented page compression to improve response items

= 3.1.7 =
* Fixed alignement issues in yearly back-end calendar view
* Fixed issue with user creation in case first name or last name blank
* Added possibility to reinitialise calendar synchronisation per resource
* Improved memory use

= 3.1.6 =
* Fixed title position in yearly back-end calendar view
* Added option to display a redirect link in case of session expiry

= 3.1.5 =
* Increased size of resource description in yearly back-end calendar
* Added new option to hide capacity when displaying resource availability
* Auto adjust end date in date picker in hotel1 template
* Fixed issue with Manage Users menu not appearing in Bookings Expert

= 3.1.4 =
* Reviewed resources setup screens
* Added maximum quantity per reservation attribute to resources

= 3.1.3 =
* Added possibility to sort by creation date in list of reservations
* Default order set to creation date in list of reservations

= 3.1.2 =
* Display product notes field of selected product in pr4 template
* Display resource capacity in pr4 template
* Added option to select quantity of resources to order in pr4 template
* Added price to pr4 template
* Fixed Danish translations
* Verified compatibility with WP version 3.5.2

= 3.1.1 =
* Increased session time out
* Added HTML editor to resource notes field

= 3.1.0 =
* Fixed issue with calendar monthly back/forward buttons not working in some front end templates
* Fixed issue with resource notes field containing extra spaces
* Updated list of fields displayed when viewing products/services
* Improved performance of ajax calls
* Suppress user registration emails

= 3.0.2 =
* Removed js subdirectory
* Fixed issue with SUMMARY template variable not being parsed in email
* Added new CLIENTEMAIL template variable
* Fixed issue with double clicking on calendar slots in the back-end causing double popup windows to load

= 3.0.1 =
* Added new option in Setup menu to define custom css styles
* Fixed issue with display of availability in hotel2 template

= 3.0.0 =
* Added hotel2 template
* Added setting to disable online booking part, showing availability only
* Added user management to Expert version
* Added support for setting up products and services occuring on predefined times which can be used for classes, events, etc
* Added new TOTALPRICE custom template field
* When using products, only display quantity of reserved items if quantity is more than one

= 2.2.3 =
* Changed long date format for Dutch
* Added option to view products with predefined dates in default calendar views

= 2.2.2 =
* Added support for setting up products and services occuring on predefined times which can be used for classes, events, etc (alpha release)

= 2.2.1 =
* Added alert in template parser when using fields STARTDATE, STARTTIME, etc in combination with multi slot reservations
 
= 2.2.0 =
* Added possibility to define own payment methods (for bank transfers and cheques for example)
* Fixed issue with date pop-ups not working when editing a reservation a second time
* Add size attribute to email field and set default size to 30 characters

= 2.1.0 =
* Removed obsolete java scripts
* Improved look and feel of reservation details in back-end
* Fixed issue with check availability when viewing a reservation in back-end
* Changed icons to buttons in back-end calendar and schedule views

= 2.0.8 =
* Fixed issue with session expired message appearing when using multiple bookings short codes on page
* Fixed issue with resource phone number not appearing in email
* Fixed issue with [DATES] template variable not being parsed correctly
* In case product pricing is nil, check if pricing defined on resource level
* Added minimum duration in days when using full day schedules

= 2.0.7 =
* Improved memory handling of simple_html_dom library
* Fixed issue with iOS syncing
* If sync per resource then customer name is displayed in calendar instead of resource name
* Updated instructions for setup of sync on iCal

= 2.0.6 =
* Added 'resourcerequired' bookings short code parameter
* Removed link in session expired message

= 2.0.5 =
* Fixed issue with use of home_url() in assigning unique ID
* Added contents of summary field to CSV export
* Added management of sessions
* Fixed issue with calendar types set at schedule level

= 2.0.4 =
* Fixed issue with display of products in template rp2 when only 1 resource is active
* Fixed compatiblity issue for WP versions lower than 3.2.1

= 2.0.3 =
* Added option to auto scroll page to bookings section
* Improved use of multiple [bookings] short codes on same page
* Fixed issue in schedule3 when selecting time range wider than 3 months
* Verified compatibility with Wordpress 3.5.1

= 2.0.2 =
* Added sync type to settings allowing to choose whether to sync schedules or resources
* Fixed issue with accessories not displaying
* Fixed issue with first availability date not displaying correctly if no availability in selected month(s)
* Added possibility to skip first page when passing a resource in URL parameters
* Improved compatiblity with older versions of jQuery (.button)

= 2.0.1 =
* Fixed performance issues when displaying available dates only in calendar
* Removed hidden en show summary options from schedule
* Added multiple registration forms to Expert edition
* Fixed issue with formatting of base price
* Added option to display available days in calendar
* Fixed pricing issue when selecting multiple quantities in hotel1 template

= 2.0.0 =
* Added SMS notifications
* Added possibility to define template at schedule level
* Added daily, monthly and new weekly view in back-end calendar
* Added possibility to choose between 'compact' and 'normal' calendar layout at schedule level
* Added weekly view to front end calendar and possibility to switch between weekly and daily views
* Added option to enable/disable syncing of blackouts
* Fixed conflict with Wordpress .spinner class
* Changed order of additional fields in back-end to display in same order as defined on registration form
* Fixed issue with line breaks between additional fields in confirmation email
* Fixed issue with date selector in back end calender defaulting to 2001
* Fixed issue with calendar pop up on hotel1 and schedule1 templates

= 1.8.7 =
* Fixed issue with error when adding a dropdown field to the registration form
* Removed console debug

= 1.8.6 =
* Fixed issue with Google Calendar subscriptions and empty messages
* Fixed issue with [ADDTOCALENDAR] template code
* Cosmetic changes to schedule3 template
* Changed behaviour of month drop down in front end calendar to take the user to next year depending on chosen month
* Added ZAR currency
* Fixed issue with adding accessories error
* Verified compatibility with Wordpress version 3.5
* Fixed issue with date jump on schedule2 template not going to next year
* Added multiple choice type of field to form editor
* Improved use of dropdown field type in form editor
* Replace field drop down by a field list in form editor
* Improved general usability when creating a form

= 1.8.5 =
* Fixed issue with capitalised domain names and syncing
* Fixed issue with characters in French emails
* Ordered resources by schedule ID in resources list
* Auto blackout days that are not within the range Weekday Start + Days to Show
* Remove auto loading rel=next post link in header
* Go directly to calendar on hotel1, schedule1 and schedule2 templates
* Fixed issue with template rp3 when using schedule other than default
* Removed debug code
* Added new calendar templates

= 1.8.4 =
* Fixed issue with Bulgarian language encoding
* Fixed issue in template rp3
* Fixed issue with minimum reservation time defined on resource level not being taken into account when looking for availability

= 1.8.3 =
* Fixed issue where no quantity input field was shown if the resource allows unlimited capacity
* Display correct color codes for reservations in back end schedule overview
* Fixed issue with schedule calendar only showing 6 first reservations for a set date and time
* Fixed security issue (thanks to Charlie Eriksen via Secunia SVCRP)

= 1.8.2 =
* Added tiered pricing
* Added pricing on resource level
* Added seasonal pricing
* Added accessories new feature
* Updated links to support departments
* Fixed issue with reservation summary not showing when viewing reservation but only when modifying or approving

= 1.8.1 =
* Fixed issue with total pricing when using hotel1 template
* Added option to hide unavailable slots
* In case products/services are used and a time slot is set, the calendar will show start and end times based on the selected time slot
* Fixed issues with formatting of amounts when trying to pay after a payment abort
* Added option to pay on customer's reservations control panel
* Set reservations to status unapproved until payment is received in cases where a payment is due
* Added CHF and NOK to list of currencies
* Fixed issue when using upper case user names in Wordpress
* Added new template variable [DETAILS] showing reservation details in case of multiple slot or multiple product/service bookings
* Added new [bookings] short code parameter 'shownames' allowing to display names of users having made reservations
* Fixed issue with schedule1 template where reservations not saved correctly (missing schedule ID)
* Fixed issue with blank admin emails being sent
* Fixed issue with changing dates not working after 1.8.0 upgrade caused by obsolete debugging instructions

= 1.8.0 =
* Fixed issue with link to Wordpress user profile
* Don't send email when email template defined and content is empty
* Don't send email admin in case of modification, deletion or approval
* Added custom filter 'bookings_http_call'
* Fixed issue with forms editor not displaying forms in certain cases

= 1.7.9 =
* Added [ADDTOCALENDAR] variable in email templates
* Verified compatibility with Wordpress version 3.4.2
* Fixed issue where when using selected dates, reservations on first day are not shown
* Removed display of user who made the reservation in front end calendar when in admin mode
* Hide date selection boxes when using selected dates and all dates are displayed using the [bookings] daystoshow attribute
* Replaced email and text template new lines with html line break in emails and texts  
* Added possibility to link to Wordpress user profile

= 1.7.8 =
* Don't allow change of time when approving a reservation
* When using 'daystoshow' don't show more dates than available
* Fixed issue with date selector not working when days to show is set to specific dates
* Added DKK currency
* Fixed issue with reservation template not being parsed in combination with multiple slot bookings
* Fixed issue with unavailability message not showing correct start and end times
* Fixed issue with prices not tallying when using hour units on product level
* Fixed issue with products+resources template not auto refreshing resource list when changing product
* Added option to select all resources from all schedules in templates products+resources and resources+products [bookings template=products+resources schedule=*]
* Ajaxified date selector on calendar page
* Fixed encoding issue with Portuguese language files

= 1.7.7 =
* Show currency symbol instead of ISO code if known
* Fixed issue where pop up boxes don't load properly (themes using ob_start)
* Fixed issue with client.css not being loaded in version 1.7.6
 
= 1.7.6 =
* Simplified error logging
* Fixed issue with help links

= 1.7.5 =
* Added reminder function (Pro)
* Added new [bookings1], [bookings2], [bookings3], [bookings4] short codes to enable display of specific text on every single bookings process page
* Added Moneybookers payment gateway (Pro)
* Fixed issue with approvals not being available in free version
* Fixed issue with non breaking space appearing as &nbsp in product summary
* Added option to select schedule by admin email in [bookings] short code
* Removed loading of Twitter and Facebook buttons on all pages except configuration page
* Changed default page to Schedule Calendar
* Fixed formatting issue of amounts in hotel1 template
* Fixed issue with double display of currency in checkout
* Fixed issue with add to calendar link
* Fixed issue with payment gateway fields not being hidden automatically (formfield.jquery.js not loaded)
* Fixed issue with resources not being refreshed when editing products (repeatable.jquery.js, not loaded)

= 1.7.4 =
* Fixed issue with parsing of [PRODUCT] template variable
* Fixed issue where [LOCATION] displayed the site name instead of the resource location in case of multi-slot bookings
* Fixed issue with formatting of Paypal amounts
* Fixed issue with Google Calendar sync links containing underscores in some cases which is not accepted as a valid URL by Google
* Fixed issue with resource name NAME template field not being filled correctly in certain cases
* Fixed issue with quantity not being applied to total price
* Allow admin users to override minimum break time between bookings when making bookings or entering blackouts in the back end
* Black out break times in between bookings if set
* Added more Swedish translations

= 1.7.3 =
* Removed console logging messages
* Added pricing unit to products & services pricing
* Fixed issue with some template fields not being available for multi slot reservations

= 1.7.2 =
* Added option to participate in show case
* Fixed formatting issue with price being displayed at the end of checkout
* Fixed issues with emails in case of multi slot reservations
* Changed formatting of default email sent
* Added customer name to default email
* Fixed issue with selection of quantity in front end process in case of multi capacity resource
* Updated Add by URL Google Calendar instructions
* Fixed issue with Google Calendar subscription links not loading
* Added customer email and phone number to search export (CSV and XML formats)

= 1.7.1 =
* Added high light of selected day in back-end calendar
* Added possibility to subscribe to Bookings calendars from Google Calendar
* Fixed user login conflict occuring in certain circumstances
* Fixed issue with format of times in schedule1 template

= 1.7.0 =
* Added multi slot booking possibility
* Fixed issue where reserved slots are not shown when selected dates are chosen for days to view
* Added possibility to capture number of participants/units to book in case of multi-capacity bookings
* Fixed issue with phone number not being captured for users who already had reservations registered
* Fixed issue where first name and last name are not being updated during new bookings
* Changed the way admin emails are being sent, instead of a Bcc, a new email is sent to the admin if requested to do so
* Changed title of admin email to distinguish it better from the customer email
* Added client phone as parameter in confirmation messages and emails
* Added possibility to use custom form fields defined in registration form in the confirmation messages and emails
* Fixed issue where total price not calculated properly when booking multiple days
* Added highlight of selected day in front end calendar
* Show name of selected product in second and third screen of bookings process
* Added product name in confirmation message and email
* Added new template rp2

= 1.6.9 =
* Fixed issue with front end calendar not showing correctly in Japanese
* Added SEK and MXN currencies
* Tested compatibility with WP 3.4

= 1.6.8 =
* Fixed release issue

= 1.6.7 =
* Updated allowed extensions to 'jpg','bmp','png','zip','pdf','gif','doc','xls','wav','jpeg','docx','ppt','pptx','mp3'
* If not using SMTP email and admin email alert activated, the email address is added to the list of recipients as BCC is not working in this case
* Added MXN currency

= 1.6.6 =
* Fixed issue with US vs Europe date formats for date field
* Added time picker widget to Time element type
* Removed europe_date element type and added option to select date format (US or Europe) to date element type

= 1.6.5 =
* Fixed issue with activation of Form Editor
* Added new currencies: NZD, AUD, CAD
* Fixed issue with saving form throwing an error
* Checked compatibility with Wordpress version 3.3.2

= 1.6.4 =
* Added possibility to create a user during reservation creation in back-end
* Removed sending of user registration confirmation to user
* Fixed issue with multi-capacity slots showing available and overlapping with blackouts

= 1.6.3 =
* Added new compact1 template displaying date selector to the left and time selector the right on the front end calendar screen
* In default, buttons and compact1 templates skip first screen if only 1 resource to select (if [bookings] short code variable skip is set to 'yes')
* In schedule1, schedule2 and hotel templates, skip the first screen displaying the 'Next' button (if [bookings] short code variable skip is set to 'yes')
* Updated readme.txt and settings page regarding the use of web services and data privacy policy
* Removed inline styles from back-end schedule calendar
* Only allocate new API key and secret if none exist
* Fixed rendering of UTF-8 characters in field labels 
* Added BOOKINGURL as a template variable representing the URL to the website page where the customer can manage their booking
* Updated css to force removal of bullets in form display
* Disabled Norwegian as it's not completely translated
* Fixed issue with open bookings not showing in front end after user cancels a booking
* Fixed issue with booking cancellation in front end not working when not using permalinks but page_id instead
* Fixed issue with booking form configuration being reset after upgrade
* Added "form" [bookings] variable to select bookings form
* Added support for multiple forms
* Fixed issue with display of multiple reservations for same resource, same time in back end schedule
* Improved display of reservations in back end schedule
* Fixed overflow display in schedule2 template
* Resource are now ordered by name in front end screen

= 1.6.2 =
* Fixed issue when switching schedules in blackouts redirecting to the schedule calendar instead of blackouts
* Fixed issue with blackouts not displaying correctly after multi-capacity upgrade

= 1.6.1 =
* Added option to download search results in XML, CSV and plain text formats
* Fixed issue with user search form in back-end where searching by letter would not work on a second booking
* Fixed issue with user search form where searching by name would redirect to the wrong page
* Fixed pagination issue in user search form
* Added class 'availability' to availability table displayed on front end
* Updated Danish language file

= 1.6.0 =
* Added support for multi-capacity reservations
* Added load of jQuery UI tabs
* Fixed issue with emails not being sent to admin in some cases
* Keep settings on deactivation
* Remove settings on uninstall
* Added secret field to account settings
* Fixed issue with date selector not showing on multi-day reservations
* Fixed formatting issue with dates when Traditional Chinese or Japanese is chosen
* Removed display of recurring or multi-day reservations in front-end calendar
* Removed bullet point in front of name on front-end calendar

= 1.5.6 =
* Allow unlicensed users access to Products & Services feature
* Added product details to reservation summary
* Fixed issue with first name and last name not being prefilled correctly for logged in users
* Added [PRODUCT] template tag for emails and confirmation messages
* Added [CLIENTNAME] template tag for emails and confirmation messages
* Disabled properties of system fields in form editor
* Fixed issue with change of date on template schedule2 not working in some cases
* Fixed issue with templates using daystoshow not showing reservations on days in the future
* Updated German language prompts

= 1.5.5 =
* Added possibility to define custom time spans
* Fixed issue with +/- buttons on product form not working
* Updated documentation and support links
* Fixed issue with product time spans not working in certain cases
* In products/resources templates, the sort order is now product name and then resource name
* Removed date fromto element from forms

= 1.5.4 =
* Fixed issue with 'link' template
* Removed obsolete css/ui-lightness folder
* Removed obsolete css/jscalendar folder
* Removed obsolet js/jscalendar folder
* Don't display unselected resources in reservation overview
* Replaced inline color styles by classes on front end reservation calendar
* Fixed issue with last name being prefilled with a question mark on registration form
* Fixed issue with 'A' beging defaulted in form fields

= 1.5.3 =
* Fixed issue with calendar.setup javascript
* Fixed issue with missing load of jQuery UI Sortable

= 1.5.2 =
* Replaced admin reservation popup window with jQuery dialog
* Replaced admin user selection and search popup window with jQuery dialog
* Set no bullet points in front end registration form
* Hide inactive resources from front end screens
* Load simple_html_dom class only when required
* Fixed wrong link to login details showing after activating calendar syncing
* Replaced Prototype/Scriptaculous scripts by jQuery
* Use WP default jQuery libraries
* Removed reminder section from blackout pop-up

= 1.5.1 =
* Fixed packaging issue

= 1.5.0 =
* Added 'event mode' allowing to define a schedule active only on certain dates
* Added new template 'schedule1' for the [bookings] short code displaying a calendar with availability for all resources (similar to the schedule calendar in the back-end)
* Added new template 'schedule2' for the [bookings] short code displaying a calendar with the possibility to search by date, showing availability for all resources
* Added new template 'hotel1' for the [bookings] short code tailored for hotels and B&B's
* Added 'daystoshow' parameter for the [bookings] short code allowing to display more than 1 day of availability in the front-end calendar
* Implemented Wordpress short code API, allowing to manage multiple bookings pages and multiple short codes on the same page
* Added reservation details on checkout page
* Fixed issue with selecting Japanese language
* Added new colors.css style sheet with the colors of the reservation statuses
* Fixed issue where when clicking 'Add' to add another product or service after having added one, the link takes you to the set up screen
* Removed loading of news info in sidebar, providing more space for other functionality
* Included local image files
* Fixed issue with back link when an error occurs creating or modifying a schedule
* Added new styling to front end buttons
* Removed seconds display from time on confirmation messages
* Displayed am/pm in lower case for consistency
* Changed default order of reservations seen by customer to show most recently created first
* Fixed issue with tooltip being offset from mouse position
* Changed Paypal item time to show reservation date instead of reservation id
* Changed Paypal invoice id to show Bookings invoice id
* Moved to same checkout form for both standard and pro users
* Fixed issue with month selector on front end calendar
* Removed showSummary javascript action from front end calendar
* Centered calendar and date jumper on front end
* Show loader icon when saving schedule or resource

= 1.4.3 =
* Fixed issue with redirects not working if PHP sessions not configured properly on client side
* Store http referer in option instead of session variable
* Delete bookings php session when deactivating
* Fixed issue with loading of Norwegian language files
* Fixed issue where Wordpress Editors and some other roles had no access to the front-end booking screens

= 1.4.2 =
* Only load admin javascript and styles on Bookings pages

= 1.4.1 =
* Fixed issue 'Invalid argument supplied for foreach() in /.../wp-content/plugins/bookings/includes/support-us.inc.php on line 51'
* Fixed issue with 'no access' being displayed on Blackouts screen
* Fixed issue with textarea element in templates

= 1.4.0 =
* Added products & services concept
* Added Paypal payment gateway (Pro)
* Added option for customers to view and cancel upcoming reservations (Pro)
* Fixed issue with timezones
* Removed 'sc1' prefix from keys
* Fixed issue with changing schedules in the 'Schedule Calendar'
* Fixed Finnish language encoding

= 1.3.3 =
* Fixed issue with url encoding

= 1.3.2 =
* Added option to send confirmation email to administrator (Pro)
* Added SMTP email settings (Pro) 
* Added approval management
* Improved role management (admin vs operator)
* Added display of region in setup panel
* Improved usability by auto redirecting after admin update
* Removed date link from front end calendar
* Removed grey background from admin screens
* Removed encapsulating html table from admin screens
* Fixed issue with front end month selector not working on some themes
* Centered day headers on front end calendar
* Removed donations reminder

= 1.3.1 =
* Added mobile sync
* Added Norwegian language
* Verified compatibility with WP 3.3
* Added new region (Europe & Africa)
* Updated documentation
* Fixed issue with Edit form link appearing on front end booking form
* Removed table containing reservation details from email when custom emails are being used
* Fixed issue with deleting resources

= 1.3.0 =
* Added possibility to define minimum time between bookings for each resource
* Added possibility to define email templates and override the default text
* Fixed issue with double body tag appearing on some pages
* Always show registration form, even for registered Wordpress users
* Updated Italian language translations
* Removed wrapping tables styling
* Changed bookings template=link parameter, 'resource' should be specified instead of 'schedule'
* Fixed 'per page' and 'cancel' links on resource page
* Fixed issue with captcha element on forms not working properly

= 1.2.0 =
* Split back-end roles in admin and user roles
* Added possibility to select required capability for admins and users
* Own reservations are now highlighted in a different color in front end
* Translated booking registration page
* Replaced [...] by 'Available' for English GB and US languages
* Added 45 minutes schedule time span
* Fixed issue with disappearing user name in front end calendar
* Changed header date format for English GB so that day appears before month
* Updated readme
* Allow navigation on days before today in back-end calendar
* Fixed Brazilian Portuguese language encoding
* Added possibility to export reservation to calendar in ICS or VCS format (Pro)
* Added 'Add to calendar' link on emails (Pro)

= 1.1.2 =
* Fixed release issue

= 1.1.1 =
* Removed Accessories and Participants tabs from reservation pop-up (back-end) as currently not used
* Fixed issue with pop-up windows not being styled properly
* Fixed issue with Change Name not working when editing a reservation in the back-end
* Fixed encoding issues with Slovenian and Slovak languages
* Fixed issue with booking confirmation not showing when default permalinks set (Pro version)

= 1.1.0 =
* Use Wordpress time settings for calendar time settings (military time vs am/pm notation)
* Fixed issue with Polish, Czech and French language files encoding
* Show registration form in all cases
* Added possibility to edit custom booking form (Pro version)

= 1.0.6 =
* Added dashboard view showing various statistics on resources and reservations
* Upgraded HttpRequest class to v1.10.02
* Added license key field for Pro features
* Days before today's date are now protected in calendar
* Added highlight of today's date in calendar

* Fixed encoding issue with Spanish and Danish language files

= 1.0.5 =
* Added new booking templates

= 1.0.4 =
* Removed obsolete cc_footer() function

= 1.0.3 =
* Fixed permissions issue for guest bookings
* Fixed issue with German language not working (encoding issue)
* Added 6 hours and 8 hours timespans

= 1.0.2 = 
* Added possibility to choose the language/locale
* Added display of reservation time in confirmation message
* Fixed issue with sending of confirmation email
* Fixed issue with minimum and maximum booking notice not being taken into account in the calendar
* Fixed issue with settings not updating properly

= 1.0.1 =
* Fixed issue with guest bookings causing a database error
* Fixed issue with multiple bookings by same anonymous user not registering

= 1.0.0 =
* Fixed issue with guest bookings throwing an HTTP 500 error on the site
* Changed menu capability level from 'administrator' to 'edit_plugins'

= 0.9.3 =
* Removed wrong plugin name in admin notices
* Forced display name as first name and/or last name when those are not specified
* Disabled check on sessions save path

= 0.9.2 =
* Fixed issue with installations running PHP 5.2 or lower
* Updated documentation and support links

= 0.9.1 =
* Beta release

= 0.9.0 =
* Alpha release