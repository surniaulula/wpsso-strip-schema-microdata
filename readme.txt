=== WPSSO Strip Schema Microdata ===
Plugin Name: WPSSO Strip Schema Microdata
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: structured data, rich snippets, schema, microdata, json-ld
Contributors: jsmoriss
Requires Plugins: wpsso
Requires PHP: 7.4.33
Requires At Least: 5.9
Tested Up To: 6.6.2
Stable Tag: 3.3.0

Remove Schema Microdata and RDFa from the webpage for better Google Rich Results using Schema JSON-LD markup.

== Description ==

<p><strong>Is Google Search reporting invalid Schema markup from your theme templates?</strong></p>

<p><strong>Do you need to remove old <em>Microdata</em> and <em>RDFa</em> markup from your theme templates?</strong></p>

<p><strong>Do you need to remove duplicate social or SEO meta tags from your webpage?</strong></p>

<!-- about -->

By default, the WPSSO Strip Schema Microdata (WPSSO SSM) add-on can remove old Schema Microdata and RDFa markup from the webpage. The settings page also allows for the optional removal of duplicate / conflicting Schema markup and meta tags from the webpage head or body sections.

WPSSO SSM filters the webpage *dynamically*, allowing you to activate or deactivate the add-on to enable or disable the removal of old Schema Microdata, RDFa, and duplicate meta tags. The WPSSO SSM webpage filter is *very* fast - generally running in under 0.003 seconds.

<!-- /about -->

<h3>WPSSO Core Required</h3>

WPSSO Strip Schema Microdata (WPSSO SSM) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/), which provides complete structured data for WordPress to present your content at its best for social sites and search results – no matter how URLs are shared, reshared, messaged, posted, embedded, or crawled.

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO Strip Schema Microdata add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/).
* [Uninstall the WPSSO Strip Schema Microdata add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

== Screenshots ==

01. WPSSO SSM settings page with options to remove of duplicate / conflicting meta tags, application/ld+json scripts, and/or Schema microdata attributes.

== Changelog ==

<h3 class="top">Version Numbering</h3>

Version components: `{major}.{minor}.{bugfix}[-{stage}.{level}]`

* {major} = Major structural code changes and/or incompatible API changes (ie. breaking changes).
* {minor} = New functionality was added or improved in a backwards-compatible manner.
* {bugfix} = Backwards-compatible bug fixes or small improvements.
* {stage}.{level} = Pre-production release: dev < a (alpha) < b (beta) < rc (release candidate).

<h3>Standard Edition Repositories</h3>

* [GitHub](https://surniaulula.github.io/wpsso-strip-schema-microdata/)
* [WordPress.org](https://plugins.trac.wordpress.org/browser/wpsso-strip-schema-microdata/)

<h3>Development Version Updates</h3>

<p><strong>WPSSO Core Premium edition customers have access to development, alpha, beta, and release candidate version updates:</strong></p>

<p>Under the SSO &gt; Update Manager settings page, select the "Development and Up" (for example) version filter for the WPSSO Core plugin and/or its add-ons. When new development versions are available, they will automatically appear under your WordPress Dashboard &gt; Updates page. You can reselect the "Stable / Production" version filter at any time to reinstall the latest stable version.</p>

<p><strong>WPSSO Core Standard edition users (ie. the plugin hosted on WordPress.org) have access to <a href="https://wordpress.org/plugins/wpsso-strip-schema-microdata/advanced/">the latest development version under the Advanced Options section</a>.</strong></p>

<h3>Changelog / Release Notes</h3>

**Version 3.3.0 (2024/08/25)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Changed the main instantiation action hook from 'init_objects' to 'init_objects_preloader'.
* **Requires At Least**
	* PHP v7.4.33.
	* WordPress v5.9.
	* WPSSO Core v18.10.0.

== Upgrade Notice ==

= 3.3.0 =

(2024/08/25) Changed the main instantiation action hook from 'init_objects' to 'init_objects_preloader'.

