=== WPSSO Strip Schema Microdata ===
Plugin Name: WPSSO Strip Schema Microdata
Plugin Slug: wpsso-strip-schema-microdata
Text Domain: wpsso-strip-schema-microdata
Domain Path: /languages
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl.txt
Assets URI: https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/
Tags: structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org
Contributors: jsmoriss
Requires Plugins: wpsso
Requires PHP: 7.2.34
Requires At Least: 5.5
Tested Up To: 6.4.0
Stable Tag: 2.15.1

Remove Schema Microdata and RDFa from the webpage for better Google Rich Results using Schema JSON-LD markup.

== Description ==

<p><strong>Is Google Search reporting invalid Schema markup from your theme templates?</strong></p>

<p><strong>Do you need to remove old <em>Microdata</em> and <em>RDFa</em> markup from your theme templates?</strong></p>

<p><strong>Do you need to remove duplicate social or SEO meta tags from your webpage?</strong></p>

<!-- about -->

The WPSSO Strip Schema Microdata (WPSSO SSM) add-on removes old Schema Microdata and RDFa markup from the webpage. The settings page also provides for the removal of duplicate / conflicting social and SEO meta tags. WPSSO SSM filters the webpage dynamically, allowing you to activate / deactivate the add-on to easily enable / disable the removal of old Schema Microdata, RDFa, and duplicate meta tags. WPSSO SSM filters are *very* fast - generally running in under 0.003 seconds!

<!-- /about -->

<h3>Users Love the WPSSO SSM Add-on</h3>

&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; - "This worked great to automatically remove almost 100 invalid microdata markup hentry entries from a divi/woocommerce project, bringing the error count to 0 in Google webmaster tools. The WPSSO plugin suite is the best out of many SSO solutions I've tried. Thank you!" - [marvtech](https://wordpress.org/support/topic/works-great-where-other-solutions-fail/)

&#x2605;&#x2605;&#x2605;&#x2605;&#x2605; - "Fantastic tool and necessary if you want proper schema markup on your website. Many themes come with markup that is unnecessary and conflicts. This handles that perfectly." - [krisfannin](https://wordpress.org/support/topic/necessary-plugin-for-proper-schema-markup/)

<h3>WPSSO Core Required</h3>

WPSSO Strip Schema Microdata (WPSSO SSM) is an add-on for the [WPSSO Core plugin](https://wordpress.org/plugins/wpsso/), which provides complete structured data for WordPress to present your content at its best on social sites and in search results – no matter how URLs are shared, reshared, messaged, posted, embedded, or crawled.

== Installation ==

<h3 class="top">Install and Uninstall</h3>

* [Install the WPSSO Strip Schema Microdata add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/).
* [Uninstall the WPSSO Strip Schema Microdata add-on](https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/).

== Frequently Asked Questions ==

== Screenshots ==

01. WPSSO SSM settings page with options to remove of duplicate / conflicting meta tags, application/ld+json scripts, and/or Schema HTML attributes.

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

**Version 2.16.0-dev.11 (2021/11/05)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the settings page load process.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.
	* WPSSO Core v16.7.0-dev.11.

**Version 2.15.1 (2023/01/26)**

* **New Features**
	* None.
* **Improvements**
	* Updated the minimum WordPress version from v5.2 to v5.5.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `WpssoAbstractAddOn` library class.
* **Requires At Least**
	* PHP v7.2.34.
	* WordPress v5.5.
	* WPSSO Core v14.7.0.

**Version 2.15.0 (2023/01/20)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Updated the `SucomAbstractAddOn` common library class.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v14.5.0.

**Version 2.14.0 (2022/12/29)**

* **New Features**
	* None.
* **Improvements**
	* Added a check for `is_sitemap_stylesheet()` to exclude sitemaps stylesheets.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v14.1.0.

**Version 2.13.1 (2022/03/07)**

Maintenance release.

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v11.5.0.

**Version 2.13.0 (2022/01/19)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Renamed the lib/abstracts/ folder to lib/abstract/.
	* Renamed the `SucomAddOn` class to `SucomAbstractAddOn`.
	* Renamed the `WpssoAddOn` class to `WpssoAbstractAddOn`.
	* Renamed the `WpssoWpMeta` class to `WpssoAbstractWpMeta`.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.14.0.

**Version 2.12.2 (2021/11/16)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Refactored the `SucomAddOn->get_missing_requirements()` method.
* **Requires At Least**
	* PHP v7.2.
	* WordPress v5.2.
	* WPSSO Core v9.8.0.

**Version 2.12.1 (2021/10/06)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Standardized `get_table_rows()` calls and filters in 'submenu' and 'sitesubmenu' classes.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v9.1.0.

**Version 2.12.0 (2021/09/24)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Removed the 'add_meta_name_wpsso:mark' filter hook for WPSSO Core v9.0.0.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v9.0.0.

**Version 2.11.2 (2021/07/10)**

* **New Features**
	* None.
* **Improvements**
	* None.
* **Bugfixes**
	* None.
* **Developer Notes**
	* Renamed the `WpssoHead->get_mt_mark()` method call to `get_mt_data()` for WPSSO Core v8.35.0.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v8.35.0.

**Version 2.11.1 (2021/02/25)**

* **New Features**
	* None.
* **Improvements**
	* Updated the banners and icons of WPSSO Core and its add-ons.
* **Bugfixes**
	* None.
* **Developer Notes**
	* None.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v5.0.
	* WPSSO Core v8.34.0.

**Version 2.11.0 (2020/12/10)**

* **New Features**
	* None.
* **Improvements**
	* Updated the SSO &gt; Strip Microdata settings page tooltip messages.
* **Bugfixes**
	* Fixed an incorrectly named option key for the removal of Schema microdata attributes.
* **Developer Notes**
	* Fixed a missing 'add_meta_name_wpsso:mark' filter hook when stripping application/ld+json scripts is enabled.
* **Requires At Least**
	* PHP v7.0.
	* WordPress v4.5.
	* WPSSO Core v8.16.0.

== Upgrade Notice ==

= 2.16.0-dev.11 =

(2021/11/05) Refactored the settings page load process.

= 2.15.1 =

(2023/01/26) Updated the minimum WordPress version from v5.2 to v5.5.

= 2.15.0 =

(2023/01/20) Updated the `SucomAbstractAddOn` common library class.

= 2.14.0 =

(2022/12/29) Added a check for `is_sitemap_stylesheet()` to exclude sitemaps stylesheets.

= 2.13.1 =

(2022/03/07) Maintenance release.

= 2.13.0 =

(2022/01/19) Renamed the lib/abstracts/ folder and its classes.

= 2.12.2 =

(2021/11/16) Refactored the `SucomAddOn->get_missing_requirements()` method.

= 2.12.1 =

(2021/10/06) Standardized `get_table_rows()` calls and filters in 'submenu' and 'sitesubmenu' classes.

= 2.12.0 =

(2021/09/24) Removed the 'add_meta_name_wpsso:mark' filter hook for WPSSO Core v9.0.0.

= 2.11.2 =

(2021/07/10) Renamed the `WpssoHead->get_mt_mark()` method call to `get_mt_data()` for WPSSO Core v8.35.0.

= 2.11.1 =

(2021/02/25) Updated the banners and icons of WPSSO Core and its add-ons.

= 2.11.0 =

(2020/12/10) Fixed an incorrectly named option key for the removal of Schema microdata attributes.

