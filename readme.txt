=== Strip Schema Microdata | WPSSO Add-on ===
Plugin Name: WPSSO Strip Schema Microdata
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org
Contributors: jsmoriss
Requires PHP: 5.6
Requires At Least: 4.2
Tested Up To: 5.4
Stable Tag: 2.0.3

Removes outdated Schema microdata from theme templates and leaves Schema JSON-LD untouched for better Google Rich Results.

== Description ==

<p style="margin:0;"><img class="readme-icon" src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png"></p>

**Want to remove incorrect or incomplete Schema Microdata from your webpages and/or theme templates?**

**Want to remove incorrect Microdata added by 3rd party plugins from your content?**

**Want to remove duplicate social or SEO meta tags from the webpage head section?**

**Is Pinterest picking up duplicate or incorrect Schema from your theme templates?**

The WPSSO Strip Schema Microdata (aka WPSSO SSM) add-on removes Schema Microdata markup from the webpage body section, leaving Schema JSON-LD markup and Schema meta tags in the head section untouched. A Strip Microdata settings page also allows you to enable the removal of duplicate / conflicting meta tags from the webpage head section.

WPSSO SSM filters the webpage content dynamically, allowing you to activate / deactivate the add-on as desired to enable / disable the removal of Schema Microdata.

WPSSO SSM filters are *very* fast &mdash; generally running in under 0.003 seconds!

<h3>Users Love the WPSSO SSM Add-on</h3>

&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; &mdash; "This worked great to automatically remove almost 100 invalid microdata markup hentry entries from a divi/woocommerce project, bringing the error count to 0 in Google webmaster tools. The WPSSO plugin suite is the best out of many SSO solutions I've tried. Thank you!" - [marvtech](https://wordpress.org/support/topic/works-great-where-other-solutions-fail/)

&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; &mdash; "Fantastic tool and necessary if you want proper schema markup on your website. Many themes come with markup that is unnecessary and conflicts. This handles that perfectly." - [krisfannin](https://wordpress.org/support/topic/necessary-plugin-for-proper-schema-markup/)

<h3>WPSSO Core Plugin Required</h3>

WPSSO Strip Schema Microdata (aka WPSSO SSM) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/).

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO SSM Add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/)
* [Uninstall the WPSSO SSM Add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/)

== Frequently Asked Questions ==

== Screenshots ==

01. WPSSO SSM settings page with options to remove of duplicate / conflicting meta tags, application/ld+json scripts, and/or Schema HTML attributes.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes / re-writes or incompatible API changes.
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Standard Version Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-strip-schema-microdata/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-strip-schema-microdata/)

<h3>Changelog / Release Notes</h3>

**Version 2.1.0-dev.4 (2020/04/04)**

* **New Features**
	* None.
* **Improvements**
	* Updated "Requires At Least" to WordPress v4.2.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored WPSSO Core active and minimum version dependency checks.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.2.
	* WPSSO Core v6.28.0-dev.4.

**Version 2.0.3 (2019/11/23)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated `WpssoSsmRegister->activate_plugin()` for the new WpssoUtilReg class in WPSSO Core.
* **Requires At Least**
	* PHP v5.6.
	* WordPress v4.0.
	* WPSSO Core v6.27.1.

== Upgrade Notice ==

= 2.1.0-dev.4 =

(2020/04/04) Updated "Requires At Least" to WordPress v4.2. Refactored WPSSO Core active and minimum version dependency checks.

= 2.0.3 =

(2019/11/23) Update for the new WpssoUtilReg class in WPSSO Core.

