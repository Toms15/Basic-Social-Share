<?php

/*
Plugin Name: Basic Social Share 
Plugin URI: 
Description: Shows the share buttons at the end of each post and add the [socialshare] code where you want them to appear on the pages.
Version: 1.0
Author: Tommaso Costantini
*/

function social_share_menu_item()
{
  add_submenu_page("options-general.php", "Basic Social Share", "Basic Social Share", "manage_options", "social-share", "social_share_page"); 
}

add_action("admin_menu", "social_share_menu_item");

function social_share_page()
{
   ?>
      <div class="wrap">
         <h1>Opzioni | Basic Social Share</h1>
 
         <form method="post" action="options.php">
            <?php
               settings_fields("social_share_config_section");
 
               do_settings_sections("social-share");
                
               submit_button(); 
            ?>
         </form>
      </div>
   <?php
}

function social_share_settings()
{
    add_settings_section("social_share_config_section", "", null, "social-share");

    add_settings_field("social-share-facebook", "Facebook", "social_share_facebook_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-twitter", "Twitter", "social_share_twitter_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-whatsapp", "WhatsApp", "social_share_whatsapp_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-tumblr", "Tumblr", "social_share_tumblr_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-telegram", "Telegram", "social_share_telegram_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-pinterest", "Pinterest", "social_share_pinterest_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-googleplus", "Google Plus", "social_share_googleplus_checkbox", "social-share", "social_share_config_section");
    add_settings_field("social-share-linkedin", "LinkedIn", "social_share_linkedin_checkbox", "social-share", "social_share_config_section");
 
    register_setting("social_share_config_section", "social-share-facebook");
    register_setting("social_share_config_section", "social-share-twitter");
    register_setting("social_share_config_section", "social-share-whatsapp");
    register_setting("social_share_config_section", "social-share-tumblr");
    register_setting("social_share_config_section", "social-share-telegram");
    register_setting("social_share_config_section", "social-share-pinterest");
    register_setting("social_share_config_section", "social-share-googleplus");
    register_setting("social_share_config_section", "social-share-linkedin");
}

function social_share_facebook_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-facebook" value="1" <?php checked(1, get_option('social-share-facebook'), true); ?> /> Abilita
   <?php
}

function social_share_twitter_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-twitter" value="1" <?php checked(1, get_option('social-share-twitter'), true); ?> /> Abilita
   <?php
}

function social_share_whatsapp_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-whatsapp" value="1" <?php checked(1, get_option('social-share-whatsapp'), true); ?> /> Abilita
   <?php
}

function social_share_tumblr_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-tumblr" value="1" <?php checked(1, get_option('social-share-tumblr'), true); ?> /> Abilita
   <?php
}

function social_share_telegram_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-telegram" value="1" <?php checked(1, get_option('social-share-telegram'), true); ?> /> Abilita
   <?php
}

function social_share_pinterest_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-pinterest" value="1" <?php checked(1, get_option('social-share-pinterest'), true); ?> /> Abilita
   <?php
}

function social_share_googleplus_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-googleplus" value="1" <?php checked(1, get_option('social-share-googleplus'), true); ?> /> Abilita
   <?php
}

function social_share_linkedin_checkbox()
{  
   ?>
        <input type="checkbox" name="social-share-linkedin" value="1" <?php checked(1, get_option('social-share-linkedin'), true); ?> /> Abilita
   <?php
}
 
add_action("admin_init", "social_share_settings");

function add_social_share_icons($content)
{
    $html = "<div class='bss-container'>";

    global $post;

    //$url = get_permalink($post->ID);
    $url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $url = esc_url($url);
    // $title = get_the_title();
    
    if(get_option("social-share-facebook") == 1)
    {   
        $html = $html . "<div class='bss-fb bss-button'><a href=\"\" onClick=\"javascript:window.open('http://www.facebook.com/sharer.php?u=" . $url . "', 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/facebook.png'><span>Facebook</span></a></div>";
    }

    if(get_option("social-share-twitter") == 1)
    {
        $html = $html . "<div class='bss-tw bss-button'><a href=\"\" onClick=\"javascript:window.open('https://twitter.com/share?url=" .  $url . "&text=' + document.title, 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/twitter.png'><span>Twitter</span></a></div>";
    }

    if(get_option("social-share-whatsapp") == 1)
    {
        $html = $html . "<div class='bss-wa bss-button'><a href=\"\" onClick=\"javascript:window.open('whatsapp://send?url=" . $url . "', 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/whatsapp.png'><span>WhatsApp</span></a></div>";
    }

    if(get_option("social-share-tumblr") == 1)
    {
        $html = $html . "<div class='bss-tu bss-button'><a href=\"\" onClick=\"javascript:window.open('http://www.tumblr.com/share/link?url=" . $url . "&name=' + document.title, 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/tumblr.png'><span>Tumblr</span></a></div>";
    }

    if(get_option("social-share-telegram") == 1)
    {
        $html = $html . "<div class='bss-tl bss-button'><a href=\"\" onClick=\"javascript:window.open('https://t.me/share/url?url=" . $url . "', 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/telegram.png'><span>Telegram</span></a></div>";
    }

    if(get_option("social-share-pinterest") == 1)
    {
        $html = $html . "<div class='bss-pi bss-button'><a href=\"\" onClick=\"javascript:window.open('https://pinterest.com/pin/create/bookmarklet/?url=" . $url . "&description=' + document.title, 'newwindow', 'width=700,height=450');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/pinterest.png'><span>Pinterest</span></a></div>";
    }

    if(get_option("social-share-googleplus") == 1)
    {
        $html = $html . "<div class='bss-gp bss-button'><a href=\"\" onClick=\"javascript:window.open('https://plus.google.com/share?url=" . $url . "', 'newwindow', 'width=415,height=500');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/googleplus.png'><span>Google Plus</span></a></div>";
    }

    if(get_option("social-share-linkedin") == 1)
    {
        $html = $html . "<div class='bss-li bss-button'><a href=\"\" onClick=\"javascript:window.open('http://www.linkedin.com/shareArticle?url=" . $url . "&title=' + document.title, 'newwindow', 'width=415,height=500');\"><img src='http://www.tommasocostantini.it/files-ext/icon-social/linkedin.png'><span>LinkedIn</span></a></div>";
    }

    $html = $html . "<div class='clear'></div></div>";

    return $content = $content . $html;
}

add_filter("the_content", "add_social_share_icons");
add_shortcode('socialshare', 'add_social_share_icons');

function social_share_style() 
{
    wp_register_style("social-share-style-file", plugin_dir_url(__FILE__) . "style.css");
    wp_enqueue_style("social-share-style-file");
}

add_action("wp_enqueue_scripts", "social_share_style");
