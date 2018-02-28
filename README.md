<h1>WPSSO Strip chema Microdata from Theme Templates to use Google&#039;s recommended Schema JSON-LD markup</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>WPSSO Strip Schema Microdata</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>WPSSO Core extension to remove outdated / incomplete Schema Microdata, leaving the Google recommended Schema JSON-LD markup untouched.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>1.3.0</td></tr>
<tr><th align="right" valign="top" nowrap>Requires At Least</th><td>WordPress 3.8</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To</th><td>WordPress 4.9.4</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org</td></tr>
</table>

<h2>Description</h2>

<p><img class="readme-icon" src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png"></p>

<p><strong>Is your Schema <em>Microdata</em> getting in the way of Google reading its preferred Schema JSON-LD markup?</strong></p>

<p><strong>Do you need to remove incorrect / incomplete Schema <em>Microdata</em> from your theme templates?</strong></p>

<p><strong>Do you need to remove Schema <em>Microdata</em> added by 3rd party plugins from your content?</strong></p>

<p><strong>Is Pinterest picking up duplicate / incorrect Schema from your theme templates?</strong></p>

<p><strong>Are you using the <a href="https://wordpress.org/plugins/wpsso-schema-json-ld/">WPSSO Schema JSON-LD Markup</a> extension for better SEO</strong> (and want to remove the old Schema Microdata from your theme templates)?</p>

<p>The WPSSO Strip Schema Microdata (aka WPSSO SSM) extension removes Schema Microdata markup from the webpage body section, leaving the (<em>Google preferred and recommended</em>) Schema JSON-LD markup and Schema meta tags in the head section untouched.</p>

<p>WPSSO SSM filters the webpage content dynamically, allowing you to activate / deactivate the extension as desired to enable / disable the removal of Schema Microdata. A "Strip Microdata" settings page allows you to enable the removal of duplicate / conflicting meta tags from the webpage head section as well.</p>

<p><em>WPSSO SSM filters are very fast</em> &mdash; generally running in under 0.003 seconds &mdash; and enabling the removal of duplicate meta tags won't add much to this, but I would suggest not enabling that feature unless required. If your theme and/or other plugins are adding duplicate meta tags, it's always best to disable them at their source instead of filtering them out afterwards &mdash; but if that's not possible, then you should find this WPSSO SSM feature very useful. ;-)</p>

<p><strong>WPSSO Strip Schema Microdata is <em>incredibly fast</em> and coded for performance:</strong></p>

<p>WPSSO Core and its extensions make full use of all available caching techniques (persistent / non-persistent object and disk caching), and load only the PHP library files and object classes they need, keeping their code small, fast, and light.</p>

<p>WPSSO Core and its extensions are fully tested and compatible with PHP v7.x (PHP v5.4 or better required).</p>

<h4>How do you know what it's doing? ;-)</h4>

<p>WPSSO Strip Schema Microdata (aka WPSSO SSM) includes a handy activity summary at the bottom of each webpage (as a hidden HTML comment) to inform you of how many matches it removed, and how long it took. Use your browser's "View Source" feature and scroll down to the bottom of the webpage HTML source to review the activity summary.</p>

<pre>
&lt;!-- WpssoSsmFilters::strip_schema_microdata = 41 matches \
    removed in 4 interations and 0.001799 secs --&gt;
</pre>

<h3>WPSSO Core Plugin Prerequisite</h3>

<p>WPSSO Strip Schema Microdata (aka WPSSO SSM) is an extension for the WPSSO Core plugin &mdash; which creates complete &amp; accurate meta tags and Schema markup from your existing content for social sharing, Social Media Optimization (SMO), Search Engine Optimization (SEO), Google Rich Cards, Pinterest Rich Pins, etc.</p>


<h2>Installation</h2>

<h3>Install and Uninstall</h3>

<ul>
<li><a href="https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/">Install the WPSSO SSM Extension</a></li>
<li><a href="https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/">Uninstall the WPSSO SSM Extension</a></li>
</ul>


<h2>Frequently Asked Questions</h2>

<h3>Frequently Asked Questions</h3>

<ul>
<li>None</li>
</ul>


<h2>Other Notes</h2>

<h3>Other Notes</h3>
<h3>Additional Documentation</h3>

<ul>
<li>None</li>
</ul>

