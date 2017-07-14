=== Custom Post Order ===
Contributors: oltdev
Donate link: N/A
Tags: Custom, post, order, orderby, display, post_date, ascending, 
descending , posts, categories, wordpress mu, wpmu
Requires at least: 2.6
Tested up to: 2.7
Stable tag: 1.0.2

The plugin enables any user to modify the default order by which posts are ordered when they are displayed on any page of their blog.

== Description ==

This is a simple plugin that enables users to modify the order in which posts are displayed on all pages(or in selected categories) of the blog. This is very useful when
you have a blog in which you want to display posts in the order they were posted, from the first post being the oldest one, to the last post which
is the most recent one, or the other way around. The options provided with the plugin at this moment allow users to order the displayed posts by  post date, post title,
post author, last time modified and post slug, either ascending or descending.

These post display options can be set by accessing the "Manage->Custom Post Order" link, for wp2.6, and "Tools->Custom Post Order" link, for wp2.7.

== Installation ==

This section describes how to install the plugin and get it working.

1. Download the custompostorder.zip file to a directory of your choice(preferably the wp-content/plugins folder)

2. Unzip the custompostorder.zip file into the wordpress plugins directory: 'wp-content/plugins/'

3. Activate the plugin through the 'Plugins' menu in WordPress

4. To set the order access the Wordpress Manage->Custom Post Order link, for 2.6 and Tools->Custom Post Order link, for 2.7

== Frequently Asked Questions ==

= Why is there a warning message on the admin page ? =

The previous version of the plugin did not properly account for the first-time usage of the plugin settings. In other words, you have to visit the custom post order manangement page
for the first time, in order for the plugin to initialize its variables. However, this problem was fixed in 1.1. Downloading the new version of the
plugin will fix this error.

= How do I use the plugin? =

This plugin adds a filter to the "posts_orderby" event which is used whenever posts are being displayed on your blog. This means that to use it, all
you have to do is save the custom post order options and you'll be able to see a different order of the posts displayed anywhere in your blog.

= Why does the order not change for my page ? =

The plugin was either not activated for your blog, or the page that you are on does not display posts.

== Screenshots ==

1. The custom post order management page.




