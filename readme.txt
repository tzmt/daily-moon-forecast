=== Daily Moon Forecast ===
Contributors: isabel104
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=me%40isabelcastillo%2ecom
Tags: moon forecast, daily moon, astrology, moon signs, zodiac, horoscope
Requires at least: 3.4
Tested up to: 4.0.1
Stable tag: 1.5
License: GNU GPL Version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display the current transiting moon zodiac sign and interpretation forecast, with option to add custom interpretations.

== Description ==

**New since version 1.3.4: use the shortcode to insert Daily Moon Forecast on any page or post:**

`[dailymoonforecast]`

Daily Moon Forecast plugin adds a widget to WordPress that displays the current moon zodiac sign along with a forecast, which updates automatically as the moon sign changes. The widget also displays the current local date and time of the viewer, as given by the viewer's browser. 

The forecast is simply a one-sentence or two-sentence suggestion of the general mood in the air according to the zodiac sign the moon is in. Twelve forecasts are included, one for each of the twelve zodiac signs. By default, the widget will use the included forecasts. You have the option to write your own custom forecast for each moon sign in **Settings -> Daily Moon Forecast**.

**Languages**

The default language is English. The `.mo` and `.po` translation files are included for the following languages:

- Spanish language

The plugin is translation-ready, and includes a `.pot` file to make it easy for you to translate it into other languages. If your language is not on this list, I’d be happy to add it. Contact me via the [Support Forum](http://wordpress.org/support/plugin/daily-moon-forecast) and tell me the language you’d like to see here.


**Credits**

Daily Moon Forecast uses the Swiss Ephemeris to get the longitude of the Moon. Learn more about the [Swiss Ephemeris](http://www.astro.com/swisseph/swephinfo_e.htm)


For more info, see the [FAQ](http://wordpress.org/plugins/daily-moon-forecast/faq/), the Installation instructions (link above), or the [plugin web page](http://isabelcastillo.com/docs/category/daily-moon-forecast-wordpress-plugin).

For Support or suggestions, please use the [Support Forum](http://wordpress.org/support/plugin/daily-moon-forecast).

Fork and hack [on GitHub](https://github.com/isabelc/daily-moon-forecast).

== Installation ==

1. Log in to your WordPress dashboard.
2. Go to `Plugins -> Add New`
3. Click 'Upload', then upload the plugin file that you downloaded.
4. Activate the plugin by clicking "Activate".
5. The Daily Moon Forecast widget will be available in `Appearance -> Widgets`
6. To use the widget, drag the widget to a sidebar widget area like you would any other widget.
7. To insert Daily Moon Forecast on any page or post, type this shortcode into the page or post:
	`[dailymoonforecast]`
8. By default, the included forecast interpretations will be used. To write your own custom forecast interpretations for each moon sign, go to "Settings -> Daily Moon Forecast" from your WordPress admin dashboard.

== Frequently Asked Questions ==

= Why is it stuck on Aries? =

The widget being stuck on Aries means that your server did not allow the plugin to "set file permissions." Most web hosting companies allow this. However, there are some that don't allow scripts to set file permissions to 755.  The plugin has been **tested and works** on these widely-used hosting companies:

- GoDaddy
- DreamHost
- BlueHost

The following web hosts have been found to be **incompatible**:

- Bravenet
- Easyhost.be
- HostGator


**Manual Troubleshooting**

The plugin includes a file that must have permission to execute (CHMOD 755) in order to get the moon's position from the Swiss Ephemeris. The file is:

`daily-moon-forecast/sweph/isabese`

The plugin sets this permission automatically. But, if you feel comfortable with this, you can check this file's permission on your server to be sure.


= I don't like it centered. How can I left-align the widget? =

**CSS Style Suggestions**

To left-align the widget title, add this to `style.css`:

`.widget_dmf_widget h3.widget-title {
	text-align:left;
}`


To left-align the rest of the widget, add this to `style.css`:

`.widget_dmf_widget #moonforecast {
	text-align:left;
}`


= How can I change the CSS style of the widget? =

To style the entire widget, use this selector:

`.widget_dmf_widget`

To style only the widget title, use this selector:

`.widget_dmf_widget h3.widget-title `

To style the everything except the title, use this selector, which wraps everything after the title:

`#moonforecast`

To style just the date, use this selector:

`#moonforecast #localtime`

To style just the icons, use this selector:

`#moonforecast img`

= How can I give back? =

Please [rate the plugin](http://wordpress.org/support/view/plugin-reviews/daily-moon-forecast). Thank you.


== Screenshots ==
1. Daily Moon Forecast - how it looks on your site
2. Custom Settings panel - back-end
== Changelog ==

= 1.5 =
* New - Changed textdomain to daily-moon-forecast. Now compatible with WPML.
* Fix - Shortcode was called incorrectly and generated an error.
* Tweak - Do singleton PHP class.

= 1.4.3 = 
* Maintenance: tested and passed for WP 3.9 compatibility.

= 1.4.2 = 
* Maintenance: removed advertising link, updated plugin link.
* Tweak: fixed typo in readme.

= 1.4.1 = 
* Bug fix: custom interpretations for translated languages other than English were not working.
* New: added .pot file for translations.
* New: added Spanish language translation.
* New: added rtl.css to support right-to-left languages.

= 1.4 =
* Maintenance: Updated default interpretations.
* Maintenance: Removed language files temporarily, since they are outdated.

= 1.3.4 =
* New: shortcode lets you show DMF on any page or post.
* Maintenance: updated readme text. Specified how to left-align the widget.

= 1.2 =
* New: set chmod automatically.

= 1.1 =
* New: ability to add custom interpretations.
* New: added translations for langauges: Croatian, French, Hindi, Portuguese, Serbian, Spanish

= 1.0 =
* Initial release of the WP plugin.
== Upgrade Notice ==

= 1.5 =
Fix - Shortcode was called incorrectly and generated an error.

= 1.4.1 =
This version fixes a bug with translations and custom interpretations.
