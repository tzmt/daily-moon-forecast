=== Daily Moon Forecast ===
Contributors: isabel104
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=R7BHLMCQ437SS
Tags: moon forecast, daily moon, astrology, moon signs, zodiac, horoscope
Requires at least: 3.7
Tested up to: 4.9
Stable tag: 2.1.1
License: GNU GPL Version 2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Display the current transiting moon zodiac sign and interpretation forecast, with option to add custom interpretations.

== Description ==

Daily Moon Forecast plugin adds a widget to WordPress that displays the current moon zodiac sign along with a forecast, which updates automatically as the moon sign changes. The widget also displays the current local date and time of the viewer, as given by the viewer's browser. 

The forecast is simply a one-sentence or two-sentence suggestion of the general mood in the air according to the zodiac sign the moon is in. Twelve forecasts are included, one for each of the twelve zodiac signs. By default, the widget will use the included forecasts. You have the option to write your own custom forecast for each moon sign in **Settings -> Daily Moon Forecast**.

Daily Moon Forecast uses the Swiss Ephemeris to get the longitude of the Moon.

**Languages**

The plugin is translation-ready, and includes a catalog `.pot` file to make it easy for you to translate it into other languages. 

For more info, see the FAQ, the Installation instructions (links above), or the [plugin web page](https://isabelcastillo.com/docs/about-daily-moon-forecast-wordpress-plugin "Daily Moon Forecast plugin").

For Support or suggestions, please use the official Support Forum (link above).

Fork and hack [on GitHub](https://github.com/isabelc/daily-moon-forecast).

== Installation ==

**Install and Activate**

1. Install and activate the plugin in your WordPress dashboard by going to Plugins –> Add New. 
2. Search for "Daily Moon Forecast" to find the plugin.
3. When you see it, click “Install Now” to install the plugin.
4. Click “Activate” to activate the plugin.

**Quick Setup**

1. To use Daily Moon Forecast as a widget, go to `Appearance -> Widgets` and drag the "Daily Moon Forecast" widget to a sidebar widget area like you would any other widget.
2. To insert Daily Moon Forecast on any page or post, type this shortcode into the page or post:
	`[dailymoonforecast]`
3. By default, the included forecast interpretations will be used. To write your own custom forecast interpretations for each moon sign, go to "Settings -> Daily Moon Forecast" from your WordPress admin dashboard.

**If your website uses Windows hosting**

If your website is running on a Windows operating system (i.e. using Windows hosting), then you’ll need to use the [ZodiacPress Windows Server](https://cosmicplugins.com/downloads/zodiacpress-windows-server/) plugin to make the Ephemeris work on your server. This is because the Ephemeris included in Daily Moon Forecast will not run on Windows, by default. Just install and activate the “ZodiacPress Windows Server” plugin, and it will automatically solve this problem.

== Frequently Asked Questions ==

= Why is it stuck on Aries? =

There are 3 possible reasons for the widget to be stuck on Aries.

**1.**  If your website is running on a Windows operating system (i.e. using Windows hosting), then you’ll need to use the [ZodiacPress Windows Server](https://cosmicplugins.com/downloads/zodiacpress-windows-server/) plugin to make the Ephemeris work on your server. This is because the Ephemeris included in Daily Moon Forecast will not run on Windows, by default. Just install and activate the “ZodiacPress Windows Server” plugin, and it will automatically solve this problem. Note that ZP Windows Server only works with Daily Moon Forecast version 2.0+, not with early versions of Daily Moon Forecast.

**2.**  This plugin uses the PHP exec() function. Some hosting providers disable the exec() function. If this function is disabled, the plugin will not work. If your host has disabled this function, contact them as they may have a way for you to enable it. (Check their support pages.)

**3.**  It may be that your server did not allow the plugin to set the proper file permissions for the Swiss Ephemeris. [See this](https://isabelcastillo.com/docs/about-daily-moon-forecast-wordpress-plugin#swetest) for help.

= How can I enable exec() on Namecheap host? =

[See this](https://www.namecheap.com/support/knowledgebase/article.aspx/9396/2219/how-to-enable-exec) to enable the `exec()` function on Namecheap host.

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

= 2.1.1 =
* Tweak - Updated links to plugin URL and documentation.
* Tweak - Textdomain loading should be delayed until the init action.

= 2.1 =
* Maintenance - Updated .pot language file.

= 2.0 =
* Fix - Added a solution for sites using Windows hosting. Previously, the ephemeris would not work on sites using Windows hosting.
* Fix - File permissions were not being checked properly which was causing ephemeris not to work on some sites.

= 1.5.4 =
* Maintenance - Removed stray file, widget.php.

= 1.5.3 =
* Maintenance - Removed unused includes directory.

= 1.5.2 =
* Maintenance - Changed h2 title tag on settings page to h1.

= 1.5.1 =
* Maintenance - Updated sweph binary files which may have been unreadable on some servers.

= 1.5 =
* New - Changed textdomain to daily-moon-forecast. Now compatible with WPML. The plugin now has a new .pot localization file.
* Fix - Shortcode was called incorrectly and generated an error.
* Tweak - Minify the inline js for increased page speed.
* Tweak - Do singleton PHP class.
* Tweak - Do not extract widget args.

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
* New: added translations for languages: Croatian, French, Hindi, Portuguese, Serbian, Spanish

= 1.0 =
* Initial release of the WP plugin.
== Upgrade Notice ==

= 2.1 =
2.x has IMPORTANT FIXES for ALL sites, especially for sites using Windows hosting.

= 2.0 =
Important fixes for ALL sites, especially for sites using Windows hosting.

= 1.5 =
Fix - Shortcode was called incorrectly and generated an error.

= 1.4.1 =
This version fixes a bug with translations and custom interpretations.
