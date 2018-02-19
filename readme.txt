=== WPSSO Strip Schema Microdata and Use Google's Recommended Schema JSON-LD Markup ===
Plugin Name: WPSSO Strip Schema Microdata
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org
Contributors: jsmoriss
Requires PHP: 5.4
Requires At Least: 3.8
Tested Up To: 4.9.4
Stable Tag: 1.2.7

WPSSO Core extension to remove outdated / incomplete Schema Microdata, leaving the Google recommended Schema JSON-LD markup untouched.

== Description ==

<img class="readme-icon" src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png">

**Is your Schema *Microdata* getting in the way of Google reading its preferred Schema JSON-LD markup?**

**Do you need to remove incorrect / complete Schema *Microdata* from your theme templates?**

**Do you need to remove Schema *Microdata* added by 3rd party plugins from your content?**

**Is Pinterest picking up duplicate / incorrect Schema from your theme templates?**

**Are you using the [WPSSO Schema JSON-LD Markup](https://wordpress.org/plugins/wpsso-schema-json-ld/) extension for better SEO** (and want to remove the old Schema Microdata from your theme templates)?

The WPSSO Strip Schema Microdata (aka WPSSO SSM) extension removes Schema Microdata markup from the webpage body section, leaving the (*Google preferred and recommended*) Schema JSON-LD markup and Schema meta tags in the head section untouched.

WPSSO SSM filters the webpage content dynamically, allowing you to activate / deactivate the extension as desired to enable / disable the removal of Schema Microdata. A "Strip Microdata" settings page allows you to enable the removal of duplicate / conflicting meta tags from the webpage head section as well.

*WPSSO SSM filters are very fast* &mdash; generally running in under 0.003 seconds &mdash; and enabling the removal of duplicate meta tags won't add much to this, but I would suggest not enabling that feature unless required. If your theme and/or other plugins are adding duplicate meta tags, it's always best to disable them at their source instead of filtering them out afterwards &mdash; but if that's not possible, then you should find this WPSSO SSM feature very useful. ;-)

**WPSSO Strip Schema Microdata is *incredibly fast* and coded for performance:**

WPSSO Core and its extensions make full use of all available caching techniques (persistent / non-persistent object and disk caching), and load only the PHP library files and object classes they need, keeping their code small, fast, and light.

WPSSO Core and its extensions are fully tested and compatible with PHP v7.x (PHP v5.4 or better required).

= How do you know what it's doing? ;-) =

WPSSO Strip Schema Microdata (aka WPSSO SSM) includes a handy activity summary at the bottom of each webpage (as a hidden HTML comment) to inform you of how many matches it removed, and how long it took. Use your browser's "View Source" feature and scroll down to the bottom of the webpage HTML source to review the activity summary.

<pre>
&lt;!-- WpssoSsmFilters::strip_schema_microdata = 41 matches \
	removed in 4 interations and 0.001799 secs --&gt;
</pre>

<h3>WPSSO Core Plugin Prerequisite</h3>

WPSSO Strip Schema Microdata (aka WPSSO SSM) is an extension for the WPSSO Core plugin &mdash; which creates complete &amp; accurate meta tags and Schema markup from your existing content for social sharing, Social Media Optimization (SMO), Search Engine Optimization (SEO), Google Rich Cards, Pinterest Rich Pins, etc.

== Installation ==

<h3>Install and Uninstall</h3>

* [Install the WPSSO SSM Extension](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/)
* [Uninstall the WPSSO SSM Extension](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

<h3>Frequently Asked Questions</h3>

* None

== Other Notes ==

<h3>Additional Documentation</h3>

* None

== Screenshots ==

01. WPSSO SSM settings page &mdash; manage options to remove of duplicate / conflicting meta tags, application/ld+json scripts, and/or Schema HTML attributes.

== Changelog ==

<h3>Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Free / Basic Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-strip-schema-microdata/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-strip-schema-microdata/)

<h3>Changelog / Release Notes</h3>

**Version 1.3.0-dev.2 (2018/02/19)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the WpssoSsm `min_version_notice()` method to use PHP's `trigger_error()` and include a notice to refresh plugin update information.

**Version 1.2.7 (2018/01/04)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Maintenance release.

== Upgrade Notice ==

= l.3.0-dev.2 =

(2018/02/19) Refactored the WpssoSsm min_version_notice() method to use PHP's trigger_error() and include a notice to refresh plugin update information.

= 1.2.7 =

(2018/02/04) Maintenance release.

