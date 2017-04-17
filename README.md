<h1>WPSSO Strip Schema Microdata to Use Google Recommended Schema JSON-LD Markup</h1>

<table>
<tr><th align="right" valign="top" nowrap>Plugin Name</th><td>WPSSO Strip Schema Microdata (WPSSO SSM)</td></tr>
<tr><th align="right" valign="top" nowrap>Summary</th><td>WPSSO extension to remove outdated / incomplete Schema Microdata, leaving the Google recommended Schema JSON-LD markup untouched.</td></tr>
<tr><th align="right" valign="top" nowrap>Stable Version</th><td>1.1.6</td></tr>
<tr><th align="right" valign="top" nowrap>Requires At Least</th><td>WordPress 3.7</td></tr>
<tr><th align="right" valign="top" nowrap>Tested Up To</th><td>WordPress 4.7.3</td></tr>
<tr><th align="right" valign="top" nowrap>Contributors</th><td>jsmoriss</td></tr>
<tr><th align="right" valign="top" nowrap>License</th><td><a href="https://www.gnu.org/licenses/gpl.txt">GPLv3</a></td></tr>
<tr><th align="right" valign="top" nowrap>Tags / Keywords</th><td>structured data, rich snippets, schema, microdata, duplicate, remove, strip, fix, json-ld, ld+json, json, markup, meta tags, schema.org</td></tr>
</table>

<h2>Description</h2>

<p><img class="readme-icon" src="https://surniaulula.github.io/wpsso-strip-schema-microdata/assets/icon-256x256.png"></p>

<p><strong>Does your theme include outdated, innacurate, or incomplete Schema Microdata?</strong></p>

<p><strong>Do you want to remove the Schema Microdata markup added by 3rd party plugins?</strong></p>

<p><strong>Do you prefer to use the <em>Google recommended</em> Schema JSON-LD markup standard?</strong></p>

<p><strong>Are you using <a href="https://wordpress.org/plugins/wpsso-schema-json-ld/">the WPSSO JSON extension</a></strong> and would like to remove incorrect or duplicate Schema Microdata from your theme templates?</p>

<p>The WPSSO Strip Schema Microdata (WPSSO SSM) extension removes unwanted Schema Microdata markup from the webpage body, leaving Schema JSON-LD markup and Schema meta tags in the head section untouched. WPSSO SSM filters the webpage content <em>dynamically</em>, allowing you to activate / deactivate the plugin as desired to enable / disable the removal of Schema Microdata. A "Strip Microdata" settings page allows you to enable the removal of duplicate / conflicting meta tags from the webpage head and/or body sections as well (disabled by default).</p>

<p><strong>The WPSSO SSM filters are very fast</strong> – generally running in under 0.003 seconds – and enabling the removal of duplicate meta tags won't add much to this, but I would suggest not enabling that feature unless you need it. If your theme and/or other plugins are adding duplicate meta tags, it's always best to disable them at their source instead of filtering them out afterwards – but if that's not possible, then you should find this WPSSO SSM feature very useful. ;-)</p>

<h4>How do you know what it's doing? ;-)</h4>

<p>WPSSO SSM includes a handy activity summary at the bottom of each webpage (as a hidden HTML comment) to inform you of how many matches it removed, and how long it took. Use your browser's "View Source" feature and scroll down to the bottom of the webpage HTML source to review the activity summary.</p>

<pre>
&lt;!-- WpssoSsmFilters::strip_schema_microdata = 41 matches \
    removed in 4 interations and 0.001799 secs --&gt;
</pre>

<blockquote>
<p><strong>Prerequisite</strong> &mdash; WPSSO Strip Schema Microdata (WPSSO SSM) is an extension for the <a href="https://wordpress.org/plugins/wpsso/">WordPress Social Sharing Optimization (WPSSO)</a> plugin, which <em>automatically</em> generates complete and accurate meta tags + Schema markup from your content for Social Sharing Optimization (SSO) and Search Engine Optimization (SEO).</p>
</blockquote>


<h2>Installation</h2>

<h4>Install and Uninstall</h4>

<ul>
<li><a href="https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/install-the-plugin/">Install the Plugin</a></li>
<li><a href="https://wpsso.com/docs/plugins/wpsso-strip-schema-microdata/installation/uninstall-the-plugin/">Uninstall the Plugin</a></li>
</ul>


<h2>Frequently Asked Questions</h2>

<h4>Frequently Asked Questions</h4>

<ul>
<li>None</li>
</ul>


<h2>Other Notes</h2>

<h3>Other Notes</h3>
<h4>Additional Documentation</h4>

<ul>
<li>None</li>
</ul>

