=== WPSSO Strip Schema Microdata for Superior Google Schema JSON-LD Markup ===
Plugin Name: WPSSO Strip Schema Microdata (WPSSO SSM)
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Donate Link: https://www.paypal.me/surniaulula
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: schema.org, schema, microdata, remove, strip, fix, json-ld, ld+json, json, markup, google
Contributors: jsmoriss
Requires At Least: 3.7
Tested Up To: 4.7.1
Stable Tag: 1.0.4-1

WPSSO extension to remove outdated Schema Microdata, leaving the superior Schema JSON-LD markup untouched for Google.

== Description ==

<p><img src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png" width="256" height="256" style="width:33%;min-width:128px;max-width:256px;float:left;margin:0 40px 20px 0;" /><strong>Does your theme include outdated, innacurate, or incomplete Schema Microdata?</strong></p>

<p><strong>Do you prefer using the latest (and much better) Schema JSON-LD markup standard?</strong></p>

<p><strong>Do you want to remove Schema Microdata markup added by 3rd party plugins?</strong></p>

<p><strong>Are you using <a href="https://wordpress.org/plugins/wpsso-schema-json-ld/">the WPSSO JSON extension</a> (recommended) and would like to remove incorrect Schema Microdata from your theme templates?</strong></p>

<p>The WPSSO Strip Schema Microdata (WPSSO SSM) extension removes unwanted Schema Microdata markup from the webpage body, leaving Schema JSON-LD markup and Schema meta tags in the head section untouched. WPSSO SSM filters the webpage content dynamically, allowing you to activate / deactivate the plugin to enable / disable the removal of Schema Microdata.</p>

= Is it working? =

<p>The WPSSO SSM extension does not have any settings &mdash; it removes Schema Microdata markup automatically from the webpage body and includes an activity summary at the bottom (as a hidden HTML comment):</p>

<pre>
&lt;!-- WpssoSsmFilters::remove_schema_microdata = 41 matches removed in 4 interations and 0.001799 secs --&gt;
</pre>

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Strip Schema Microdata (WPSSO SSM) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> creates complete and accurate meta tags and Schema markup for Social Sharing Optimization (SSO) and SEO.</p>
</blockquote>

== Installation ==

= Install and Uninstall =

* [Install the Plugin](https://wpsso.com/codex/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/)
* [Uninstall the Plugin](https://wpsso.com/codex/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

= Frequently Asked Questions =

* None

== Other Notes ==

= Additional Documentation =

* None

== Screenshots ==

== Changelog ==

= Free / Basic Version Repository =

* [GitHub](https://surniaulula.github.io/wpsso-strip-schema-microdata/)
* [WordPress.org](https://wordpress.org/plugins/wpsso-strip-schema-microdata/developers/)

= Version Numbering Scheme =

Version components: `{major}.{minor}.{bugfix}-{stage}{level}`

* {major} = Major code changes / re-writes or significant feature changes.
* {minor} = New features / options were added or improved.
* {bugfix} = Bugfixes or minor improvements.
* {stage}{level} = dev &lt; a (alpha) &lt; b (beta) &lt; rc (release candidate) &lt; # (production).

Note that the production stage level can be incremented on occasion for simple text revisions and/or translation updates. See [PHP's version_compare()](http://php.net/manual/en/function.version-compare.php) documentation for additional information on "PHP-standardized" version numbering.

= Changelog / Release Notes =

**Version 1.0.4-1 (2017/01/08)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Added a 'plugins_loaded' action hook to load the plugin text domain.

**Version 1.0.3-1 (2016/11/25)**

* *New Features*
	* None
* *Improvements*
	* None
* *Bugfixes*
	* None
* *Developer Notes*
	* Refactored the min_version_notice() method and moved variables to config class.

== Upgrade Notice ==

= 1.0.4-1 =

(2017/01/08) Added a 'plugins_loaded' action hook to load the plugin text domain.

= 1.0.3-1 =

(2016/11/25) Refactored the min_version_notice() method.

