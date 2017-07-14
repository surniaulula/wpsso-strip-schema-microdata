=== WPSSO Strip Schema Microdata to Use Google Recommended Schema JSON-LD Markup ===
Plugin Name: WPSSO Strip Schema Microdata
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org
Contributors: jsmoriss
Requires At Least: 3.7
Tested Up To: 4.8
Stable Tag: 1.2.1

WPSSO extension to remove outdated / incomplete Schema Microdata, leaving the Google recommended Schema JSON-LD markup untouched.

== Description ==

<img class="readme-icon" src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png">

<p><strong>Do you need to fix incorrect Schema Microdata in your theme templates?</strong></p>

<p><strong>Do you need to remove Schema Microdata markup added by 3rd party plugins?</strong></p>

<p><strong>Do you prefer the <em>Google recommended</em> Schema JSON-LD markup standard?</strong></p>

<p><strong>Is Pinterest picking up duplicate / incorrect Schema from your theme templates?</strong></p>

<p><strong>Are you using the <a href="https://wordpress.org/plugins/wpsso-schema-json-ld/">WPSSO Schema JSON-LD Markup</a> extension for Google SEO</strong> and want to remove the old Schema Microdata from your theme templates?</p>

<p>The WPSSO Strip Schema Microdata extension removes Schema Microdata markup from the webpage body section, leaving the <em>Google recommended</em> Schema JSON-LD markup and Schema meta tags in the head section untouched. WPSSO SSM filters the webpage content <em>dynamically</em>, allowing you to activate / deactivate the extension as desired to enable / disable the removal of Schema Microdata. A "Strip Microdata" settings page allows you to enable the removal of duplicate / conflicting meta tags from the webpage head section as well (disabled by default).</p>

<p><strong>The WPSSO SSM filters are very fast</strong> – generally running in under 0.003 seconds – and enabling the removal of duplicate meta tags won't add much to this, but I would suggest not enabling that feature unless you need it. If your theme and/or other plugins are adding duplicate meta tags, it's always best to disable them at their source instead of filtering them out afterwards – but if that's not possible, then you should find this WPSSO SSM feature very useful. ;-)</p>

= How do you know what it's doing? ;-) =

<p>WPSSO SSM includes a handy activity summary at the bottom of each webpage (as a hidden HTML comment) to inform you of how many matches it removed, and how long it took. Use your browser's "View Source" feature and scroll down to the bottom of the webpage HTML source to review the activity summary.</p>

<pre>
&lt;!-- WpssoSsmFilters::strip_schema_microdata = 41 matches \
	removed in 4 interations and 0.001799 secs --&gt;
</pre>

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Strip Schema Microdata is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WPSSO</a> plugin, which <em>automatically</em> generates complete and accurate meta tags + Schema markup from your content for social media optimization (SMO) and SEO.</p>
</blockquote>

== Installation ==

= Install and Uninstall =

* [Install the Plugin](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

01. WPSSO SSM settings page &mdash; manage options to remove of duplicate / conflicting meta tags, application/ld+json scripts, and/or Schema HTML attributes.

== Changelog ==

= Free / Basic Version Repository =

* [GitHub](https://surniaulula.github.io/wpsso-strip-schema-microdata/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-strip-schema-microdata/developers/)

= Version Numbering =

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

= Changelog / Release Notes =

**Version 1.2.1 (2017/07/14)**

* *New Features*
	* None
* *Improvements*
	* Added an is_feed() check to skip content from feeds. 
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.2.0 (2017/07/09)**

* *New Features*
	* None
* *Improvements*
	* Added support for two new constants:
		* WPSSOSSM_ERROR_LOG_DISABLE
		* WPSSOSSM_COMMENT_DISABLE
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.8 (2017/07/03)**

* *New Features*
	* None
* *Improvements*
	* Added a check for an empty webpage (possible redirect).
	* Added a check for a duplicate "<body " string in the webpage.
* *Bugfixes*
	* None
* *Developer Notes*
	* Added PHP error_log() messages if the "<body " string is not found or a duplicate string is found.

**Version 1.1.7 (2017/04/30)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

**Version 1.1.6 (2017/04/17)**

* *New Features*
	* None
* *Improvements*
	* Added 'itemid' to the list of Schema attributes that are removed.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.5 (2017/04/16)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the plugin init filters and moved/renamed the registration boolean from `is_avail[$name]` to `is_avail['p_ext'][$name]`.

**Version 1.1.4 (2017/04/10)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* Fixed the head section byte count to retain the newline character.
* *Developer Notes*
	* None

**Version 1.1.3 (2017/04/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Minor revision to move URLs in the extension config to the main WPSSO plugin config.
	* Dropped the package number from the production version string.

**Version 1.1.2-1 (2017/04/05)**

* *New Features*
	* None
* *Improvements*
	* Updated the plugin icon images and the documentation URLs.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.1-1 (2017/03/25)**

* *New Features*
	* None
* *Improvements*
	* Added the "Application/LD+JSON Scripts" and "Schema HTML Attributes" options under the Head Section tab as well (disabled by default).
* *Bugfixes*
	* None
* *Developer Notes*
	* None

**Version 1.1.0-1 (2017/03/19)**

* *New Features*
	* Added a new "Strip Microdata" settings page with options to manage the removal of duplicate / conflicting meta tags, application/ld+json scripts, and Schema HTML attributes.
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the WpssoSsmFilters strip_schema_microdata() method and added support for the removal of duplicate / conflicting meta tags.

**Version 1.0.6-1 (2017/03/01)**

* *New Features*
	* None
* *Improvements*
	* Added removal of application/ld+json scripts from the webpage body.
* *Bugfixes*
	* None
* *Developer Notes*
	* None

== Upgrade Notice ==

= 1.2.1 =

(2017/07/14) Added an is_feed() check to skip content from feeds. 

= 1.2.0 =

(2017/07/09) Added support for two new constants: WPSSOSSM_ERROR_LOG_DISABLE and WPSSOSSM_COMMENT_DISABLE.

= 1.1.8 =

(2017/07/03) Added a check for an empty webpage (possible redirect). Added a check for a duplicate "<body " string in the webpage. Added a PHP error_log() messages for errors.

= 1.1.7 =

(2017/04/30) Code refactoring to rename the $is_avail array to $avail for WPSSO v3.42.0.

= 1.1.6 =

(2017/04/17) Added 'itemid' to the list of Schema attributes that are removed.

= 1.1.5 =

(2017/04/16) Refactored the plugin init filters and moved/renamed the registration boolean.

= 1.1.4 =

(2017/04/10) Fixed the head section byte count to retain the newline character.

= 1.1.3 =

(2017/04/08) Minor revision to move URLs in the extension config to the main WPSSO plugin config.

= 1.1.2-1 =

(2017/04/05) Updated the plugin icon images and the documentation URLs.

= 1.1.1-1 =

(2017/03/25) Added the "Application/LD+JSON Scripts" and "Schema HTML Attributes" options under the Head Section tab as well (disabled by default).

= 1.1.0-1 =

(2017/03/19) Added a new "Strip Microdata" settings page with options to manage the removal of duplicate / conflicting meta tags, application/ld+json scripts, and Schema HTML attributes.

= 1.0.6-1 =

(2017/03/01) Added removal of application/ld+json scripts from the webpage body.

