=== Edin ===

Contributors: automattic
Tags: blue, gray, white, light, two-columns, left-sidebar, right-sidebar, responsive-layout, custom-background, custom-colors, custom-header, custom-menu, editor-style, featured-images, flexible-header, full-width-template, post-formats, rtl-language-support, sticky-post, theme-options, translation-ready

Requires at least: 3.5
Tested up to: 3.9
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A modern business theme.

== Description ==

Edin is a fully responsive theme, ideal for creating a strong — yet beautiful — online presence for your business.

* Responsive layout.
* Front Page Template.
* Full Width Page Template
* Grid Page Template
* Alternate Sidebar Page Template
* Jetpack.me compatibility for Infinite Scroll, Testimonial Custom Post Type, Responsive Videos, Site Logo.
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= How to setup the front page like the demo site? =

= I don't see the Testimonial menu in my admin, where can I find it? =

To make the Testimonial menu appear in your admin, you need to install the [Jetpack plugin](http://jetpack.me) because it has the required code needed to make [custom post types](http://codex.wordpress.org/Post_Types#Custom_Post_Types) work for the Edin theme.

Once Jetpack is active, the Testimonial menu will appear in your admin, in addition to standard blog posts. No special Jetpack module is needed and a WordPress.com connection is not required for the Testimonial feature to function. Testimonial will work on a localhost installation of WordPress if you add this line to `wp-config.php`:

`define( 'JETPACK_DEV_DEBUG', TRUE );`

The demo site URL: http://edindemo.wordpress.com/?demo

When you first activate Edin, you’ll see your posts in a traditional blog format. If you’d like to use this template as the front page of your site, follow these instructions:

1. Create or edit a page, and then assign it to the Front Page Template from the Page Attributes module.
2. Add an introduction to your site. For best results, we recommend a few paragraphs.
3. Set your front page image — behind the text — as a Featured Image.
4. Go to Settings → Reading and set “Front page displays” to “A static page.”
5. Select the page to which you just assigned the Front Page Template as “Front page,” and then choose another page as “Posts page” to display your blog posts.

= What are the theme options? =

Edin comes packed with multiple Theme Options available via the Customizer:

* Menu Style: you can choose the style of your menu, default or classic.
* Sidebar Position: you can choose to display the sidebar either on the left or right.
* Thumbnail Aspect Ratio: you can choose the aspect ratio of the thumbnails used for the Grid Page Template or for the Featured Page Areas.
* Header: show search form: display a search form in the theme’s header.
* Front Page: show title: display the Front Page Template’s title.
* Front Page: Featured Page One: select a page to feature on the Front Page Template.
* Front Page: Featured Page Two: select a page to feature on the Front Page Template.
* Front Page: Featured Page Three: select a page to feature on the Front Page Template.

= How to add the social links? =

Edin allows you to display links to your social media profiles — like Twitter and Facebook — as icons using a Custom Menu.

- Set up the menu -

To automatically apply icons to your links, simply create a new Custom Menu and give it a name that starts with “Social” (e.g. “Social Menu,” “Social Links”). This specific name is important and must match exactly. Next, add each of your social links to this menu. Each menu item should be added as a custom link.

Once your menu is created and your social links are added, you can display it in your Secondary or Footer Menu. You can also create a new Custom Menu Widget to display it in any of Edin‘s widget areas.

Edin will automatically apply an icon if it’s available.

- Available icons -

Linking to any of the following sites will automatically display its icon in your menu:

* Codepen
* Digg
* Dribbble
* Dropbox
* Facebook
* Flickr
* GitHub
* Google+
* Instagram
* LinkedIn
* Email (mailto: links)
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (urls with /feed/)
* StumbleUpon
* Tumblr
* Twitter
* Vimeo
* WordPress
* YouTube

= Where are located the widget areas? =

Edin offers seven widget areas, which can be configured in Appearance → Widgets:

* A sidebar widget area, which appears on the right or left.
* Three optional footer widget areas.
* Three optional widget areas on the Front Page Template.

= What are the extra CSS classes? =

Edin comes with two extra CSS styles, button and button-minimal. You can add these two classes to your links by using the Text Editor. We recommend creating a “call to action” button on the Front Page, for example.

== Quick Edin Specs (all measurements in pixels) ==

1. The main column width is 540 except in the full-width layout where it’s 930.
2. A widget in the sidebar is 300.
3. A widget in the Footer Widget Area or Front Page Widget Area is 330.
4. Featured Images for posts are 648 wide by unlimited high.
5. Featured Images for pages are 1230 wide by 1230 high.

== Changelog ==

= 1.2.1 - May 5 2015 =
* Remove comment form from Testimonials

= 1.2 - May 4 2015 =
* Add support for Jetpack Testimonial CPT

= 1.1.1 - Jan 21 2015 =
* Improve accessibility

= 1.1 - Nov 27 2014 =
* Add support for the Eventbrite API plugin.

= 1.0.8 - Nov 2 2014 =
* Update Site Logo template tags for Jetpack.

= 1.0.7 - Sep 8 2014 =
* Add credits to readme.txt

= 1.0.6 - Aug 29 2014 =
* Add support for gallery post format

= 1.0.5 - Aug 26 2014 =
* Use if statement for custom content width function

= 1.0.4 - Aug 14 2014 =
* Add Google fonts to the editor

= 1.0.3 - Aug 11 2014 =
* Fix UI bugs

= 1.0.2 - Aug 11 2014 =
* Introduce a new theme option: "Featured Image: remove filter"

= 1.0.1 - Aug 2 2014 =
* Fix Site Title being cut off in Customizer

= 1.0 - Jul 31 2014 =
* Initial release.

== Credits ==

* Edincon: font by Thomas Guillot (http://thomasguillot.com/), licensed under [CC0](http://creativecommons.org/choose/zero/)
* Genericons: font by Automattic (http://automattic.com/), licensed under [GPL2](https://www.gnu.org/licenses/gpl-2.0.html)
* Images: images by Viktor Hanacek (http://picjumbo.com/), licensed under [CC0](http://creativecommons.org/choose/zero/)