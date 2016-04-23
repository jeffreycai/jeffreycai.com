<?php

//session_start();

/** const **/
define(THEME_NAME, 'jTwitter');
//define(MAINTAINENCE, strpos($_SERVER['SERVER_NAME'], 'jeffreycai.com'));
define(MAINTAINENCE, false);
global $tips;
$tips = array(
    'Use the "<strong>Quick View</strong>" switch on <a href="/portfolio">Portfolio</a> and <a href="/blog">Blog</a> page for a richer and more dynamic browsing experience.',
    'This site uses HTML 5 Semantics and CSS 3. Use modern broswer (IE9 / Firefox / Chrome) for all effects.',
    'Tips are fetched randomly. Refresh the page and you might not see me again.',
    'Some people say PHP is not as secure as other language. I say it\'s the programmer that makes the difference.',
    'You can filter posts on <a href="/portfolio">Portfolio</a> and <a href="/blog">Blog</a> page by clicking the tags in the tag cloud underneath the breadcrumb.',
    'Fail to plan. Plan to fail.',
    '这是中文彩蛋，看到中文是不是很亲切？',
    'Don\'t forget to <a href="/contact">contact me</a> if you want to be in touch'
);

global $unslidable_post_ids;
$unslidable_post_ids = array(9, 13, 16);

/** site maintainece **/
if (MAINTAINENCE)
{
    header('Location: http://www.jeffreycai.com/construction');
    die();
}

/*** register sidebar ***/
if ( function_exists('register_sidebar') )
    register_sidebar();

/*** fetch tips ***/
fetch_tip();


function get_body_id()
{
    if (is_page())
    {
        $title = get_the_title();
        if (preg_match('/home/i', $title))
            return 'home';
        elseif (preg_match('/about/i', $title))
            return 'about';
        elseif (preg_match('/portfolio/i', $title))
            return 'portfolio';
        elseif (preg_match('/blog/i', $title))
            return 'blog';
        elseif (preg_match('/contact/i', $title))
            return 'contact';
    }
    elseif (get_query_var('post_type') == 'portfolio' || is_tax('portfolio_tags'))
      return 'portfolio';
    elseif (is_single() || is_archive())
        return 'blog';

}

function include_theme_file($file)
{
    $to_include = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . $file;
    if (is_file($to_include))
        include($to_include);
}

/***********  For tip ************/
function has_tip()
{
    return !empty($_SESSION['tip_'.THEME_NAME]);
}
function has_flag_on($flag)
{
    return $_SESSION[$flag.THEME_NAME] !== false;
}
function the_tip()
{
    if (has_tip())
        echo get_the_tip();
}
function get_the_tip()
{
    return $_SESSION['tip_'.THEME_NAME];
}
function unset_flag($flag)
{
    $_SESSION[$flag.THEME_NAME] = false;
}
function set_flag($flag)
{
    $_SESSION[$flag.THEME_NAME] = true;
}
function set_tip($tip)
{
    $_SESSION['tip_'.THEME_NAME] = $tip;
}
function fetch_tip()
{
    global $tips;
    set_tip($tips[array_rand($tips)]);
}
/***********************************/
function is_empty_html($html)
{
     $html = strip_tags($html);
     return empty($html);
}
function slugfy($string)
{
    return str_replace(' ', '-', trim(strtolower($string)));
}

/********* pagination **********/
function get_offset()
{
    return $_GET['pageNum'] ? (($_GET['pageNum'] - 1) * get_option('posts_per_page')) : 0;
}

function paginate($args, $base_url)
{
    $showposts = $args['showposts'] ? $args['showposts'] : get_option('posts_per_page');

    // remove pagination related args
    $args['showposts'] = 9999;
    $args['offset'] = 0;

    $loop = new Wp_query($args);
    $total = $loop->post_count;

    if ($page_count = intval(ceil(floatval($total) / $showposts)))
    {
        // we don't paginate if there is only one page
        if ($page_count == 1)
            return;
        for ($i = 0; $i < $page_count + 1; $i++)
        {
            if ($i == 0)
            {
                echo "<span>Page: </span>";
                continue;
            }
            echo "<a href='".$base_url.($i == 1 ? '' : '?pageNum='.$i)."' class='".($i == ($_GET['pageNum'] ? $_GET['pageNum'] : 1) ? 'current' : '')."'>$i</a>";
        }
    }
}


/** Others **/
function is_slidable($id)
{
    global $unslidable_post_ids;
    return !in_array($id, $unslidable_post_ids);
}




/********** register sidebar ***********/
//function jtwitter_widgets_init() {
//  // Area 1, located at the top of the sidebar.
//  register_sidebar( array(
//    'name' => __( 'Primary Widget Area', THEME_NAME ),
//    'id' => 'primary-widget-area',
//    'description' => __( 'The primary widget area', THEME_NAME ),
//    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//    'after_widget' => '</li>',
//    'before_title' => '<h3 class="widget-title">',
//    'after_title' => '</h3>',
//  ) );
//
//  // left, located at the top of the sidebar.
//  register_sidebar( array(
//    'name' => __( 'Left', THEME_NAME ),
//    'id' => 'leftCol',
//    'description' => __( 'The left column', THEME_NAME ),
//    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//    'after_widget' => '</li>',
//    'before_title' => '<h3 class="widget-title">',
//    'after_title' => '</h3>',
//  ) );
//
//  // Area 2, located below the Primary Widget Area in the sidebar. Empty by default.
//  register_sidebar( array(
//    'name' => __( 'Secondary Widget Area', THEME_NAME ),
//    'id' => 'secondary-widget-area',
//    'description' => __( 'The secondary widget area', THEME_NAME ),
//    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//    'after_widget' => '</li>',
//    'before_title' => '<h3 class="widget-title">',
//    'after_title' => '</h3>',
//  ) );
//
//  // Area 5, located in the footer. Empty by default.
//  register_sidebar( array(
//    'name' => __( 'Third Footer Widget Area', THEME_NAME ),
//    'id' => 'third-footer-widget-area',
//    'description' => __( 'The third footer widget area', THEME_NAME ),
//    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//    'after_widget' => '</li>',
//    'before_title' => '<h3 class="widget-title">',
//    'after_title' => '</h3>',
//  ) );
//
//  // Area 6, located in the footer. Empty by default.
//  register_sidebar( array(
//    'name' => __( 'Fourth Footer Widget Area', THEME_NAME ),
//    'id' => 'fourth-footer-widget-area',
//    'description' => __( 'The fourth footer widget area', THEME_NAME ),
//    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
//    'after_widget' => '</li>',
//    'before_title' => '<h3 class="widget-title">',
//    'after_title' => '</h3>',
//  ) );
//}
///** Register sidebars by running bestandlesstravel_widgets_init() on the widgets_init hook. */
//add_action( 'widgets_init', 'jtwitter_widgets_init' );










/** debug **/
class debug {
    static function dump($var)
    {
        echo "<pre>";
        var_dump($var);
        die("</pre>");
    }
    static function dumpWpquery()
    {
        global $wp_query;
        self::dump($wp_query);
    }
}
?>
