=== RS Nofollow Blogroll ===
Contributors: RedSand
Donate link: http://www.redsandmarketing.com/rs-nofollow-blogroll-donate/
Tags: nofollow, links, blogroll, seo, search engine optimization
Requires at least: 3.8
Tested up to: 4.1
Stable tag: trunk

A simple plugin that adds rel=nofollow attribute to non-homepage Blogroll Links. Improves SEO while giving link love to your favorite sites.

== Description == 

A simple plugin that adds rel="nofollow" attribute to Blogroll Links on interior pages of your site. Helps SEO while still providing some link love to your favorite sites.

The default setting for WordPress Blogrolls does not add the rel="nofollow" attribute to links. If you are familiar with Search Engine Optimization, you know that linking out to other sites from every single page of your site (as a Blogroll does) can hurt your SEO because you lose too much link juice. It also doesn't really  help the sites you're linking to because search engine don't place as much value on sitewide links - all the other sites need is one good link from your site.

This plugin will allow you to give link love to sites in your Blogroll from the homepage of your site or front page of your blog, which are most likely the strongest pages anyway. On all the other interior pages of your site, the rel="nofollow" attribute will be added to Blogroll links to prevent unnecessary bleeding of link juice. This is different from some other plugins in that it doesn't add nofollow to the Blogroll links on the homepage or the blog front page. (The homepage and the blog front page may be the same thing on many sites, but in WordPress there is a differentiation for people who have the blog at a different URL form the main WordPress directory on the same site. For example: if the WordPress directory is `yourblog.com` and the blog URL is `yourblog.com/blog/`)

For a more thorough explanation of what the plugin does and why you need it, visit the [RS Nofollow Blogroll homepage](http://www.redsandmarketing.com/plugins/rs-nofollow-blogroll/ "RS Nofollow Blogroll Plugin").

== Installation ==

= Installation Instructions =

**Option 1:** Install the plugin directly through the WordPress Admin Dashboard (Recommended)

1. Go to *Plugins* -> *Add New*.

2. Type *RS Nofollow Blogroll* into the Search box, and click *Search Plugins*.

3. When the results are displayed, click *Install Now*.

4. When it says the plugin has successfully installed, click **Activate Plugin** to activate the plugin (or you can do this on the Plugins page).

**Option 2:** Install .zip file through WordPress Admin Dashboard

1. Go to *Plugins* -> *Add New* -> *Upload*.

2. Click *Choose File* and find `rs-nofollow-blogroll.zip` on your computer's hard drive.

3. Click *Install Now*.

4. Click **Activate Plugin** to activate the plugin (or you can do this on the Plugins page).

**Option 3:** Install .zip file through an FTP Client (Recommended for Advanced Users Only)

1. After downloading, unzip file and use an FTP client to upload the enclosed `rs-nofollow-blogroll` directory to your WordPress plugins directory (usually `/wp-content/plugins/`) on your web server.

2. Go to your Plugins page in the WordPress Admin Dashboard, and find this plugin in the list.

3. Click **Activate** to activate the plugin.

= Other Notes =

This plugin has not been designed specifically for use with Multisite. It can be used in Multisite if activated *per site*, but *should not* be Network Activated. As with any plugin, test and make sure it works with your particular setup before using on a production site.

= More Info / Documentation =
For more info and full documentation, visit the [RS Nofollow Blogroll plugin homepage](http://www.redsandmarketing.com/plugins/rs-nofollow-blogroll/ "RS Nofollow Blogroll Plugin").

== Changelog ==

= 1.0.1 =
*released 04/02/15*

* Added an uninstall function that completely uninstalls the plugin and removes all options, data, and traces of its existence when it is deleted through the dashboard.
* Increased minimum required WordPress version to 3.8. It's extremely important that users stay up to date with the most recent version of WordPress (currently 4.1.1) for security and functionality.
* Fixed a few potential minor issues with UTF-8 and multibyte support.
* Made various minor code improvements.

= 1.0 =
*released 02/24/15*

* Initial release.

== Upgrade Notice ==
= 1.0.1 =
Added an uninstall function to make sure all traces of the plugin are removed upon deletion, increased minimum required WordPress Version to 3.8, and made various minor code improvements. Please see Changelog for details.

== Frequently Asked Questions ==

= Where are the options? =

This plugin is fast, and lean...there are no options needed. You install it and it just works.

= You do great work...can I hire you? =

Absolutely...go to my [WordPress Consulting](http://www.redsandmarketing.com/web-design/wordpress-consulting/ "WordPress Consulting") page for more information.
