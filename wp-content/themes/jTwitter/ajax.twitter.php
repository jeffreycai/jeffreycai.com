<?php
header('Content-Type: text/plain');
header("Cache-Control: no-cache");
header("Expires: -1"); 

try {
    include(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'Twitter.class.php');
    $twitter = new Twitter('38430808');

    foreach ($twitter->getItems()->channel->item as $item)
    {
        echo "<li>".Twitter::parseTweet($item)."<span class='timestamp'>posted at <a href={$item->link} target=_blank rel='nofollow'>".date('jS M Y', strtotime($item->pubDate))."</a></span><li>";
    }
} catch (Exception $e)
{
    global $twitter_error;
    $twitter_error = $e->getMessage();
    die('Oops, there is an error when loading twitter feed ...');
}

?>
