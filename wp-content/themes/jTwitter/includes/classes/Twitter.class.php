<?php
class Twitter {
    const debug = false;

    private $accout = '';
    private $cache_folder;
    private $tweetes_file;
    private $frequency = 30; // min
    private $feed;


    public function  __construct($account, $cache_folder = null, $frequency = 30) {
        // set vars
        $this->accout = $account;
        $this->frequency = $frequency;
        $this->cache_folder = $cache_folder ? $cache_folder : dirname(__FILE__).DIRECTORY_SEPARATOR.'cache';
        $url = 'http://api.twitter.com/1/statuses/user_timeline.rss?user_id='.$account;
        // set default cache folder path
        if (!is_dir($this->cache_folder))
                throw new Exception('Error: The twitter cache folder does not exist.');
        elseif (!is_writable($this->cache_folder))
                throw new Exception('Error: The twitter cache folder is not writable');
        // create files if they do not exist
        $this->tweetes_file = $this->cache_folder . DIRECTORY_SEPARATOR . base64_encode($url);
        if (!is_file($this->tweetes_file))
        {
            $fh = fopen($this->tweetes_file, 'w+');
            fclose($fh);
        }
        //
        if(!$this->feed = $this->getFromCache($url))
        {
            $this->feed = simplexml_load_file($url);
            $this->putInCache($url, $this->feed);
        }
    }

    public function getFromCache()
    {
        if ( is_file($this->tweetes_file) && $this->notExpired() && !self::debug )
            return simplexml_load_file($this->tweetes_file);
        else
        {
            unlink($this->tweetes_file);
            return false;
        }
    }

    public function getItems()
    {
        return $this->feed;
    }

    private function notExpired()
    {
        return floor( (time() - filemtime($this->tweetes_file)) / 60 ) <= $this->frequency;
    }

    public function putInCache($name, $xml)
    {
        if ($file = fopen($this->tweetes_file, 'w+'))
            fwrite($file, $xml->asXML());
    }

    public function parseTweet(SimpleXMLElement $item)
    {
        $text = (String)$item->title;
        $link = (String)$item->link;
        preg_match('/twitter.com\/(.*)\/statuses/', $link, $matches);
        $twitter_name = $matches[1];
        self::twitterit($text, $twitter_name);
        return $text;
    }

    public static function twitterit(&$text, $twitter_username, $target='_blank', $nofollow=true)
    {
        $urls  =  self::_autolink_find_URLS( $text );
        if(!empty($urls)) {
            array_walk( $urls, array('Twitter', '_autolink_create_html_tags'), array('target'=>$target, 'nofollow'=>$nofollow) );
            $text  =  strtr( $text, $urls );
        }
        $text = preg_replace("/(\s@|^@)([a-zA-Z0-9]{1,15})/","$1<a href=\"http://twitter.com/$2\">$2</a>",$text);
        $text = str_replace($twitter_username.": ", "",$text);
    }

    public static function _autolink_find_URLS($text)
    {
        $scheme = '(http:\/\/|https:\/\/)';
        $www = 'www\.';
        $ip = '\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}';
        $subdomain = '[-a-z0-9_]+\.';
        $name = '[a-z][-a-z0-9]+\.';
        $tld = '[a-z]+(\.[a-z]{2,2})?';
        $the_rest = '\/?[a-z0-9._\/~#&=;%+?-]+[a-z0-9\/#=?]{1,1}';
        $pattern = "$scheme?(?(1)($ip|($subdomain)?$name$tld)|($www$name$tld))$the_rest";
        $pattern = '/'.$pattern.'/is';
        $c = preg_match_all($pattern, $text, $m);
        unset($text, $scheme, $www, $ip, $subdomain, $name, $tld, $the_rest, $pattern);
        if($c) {
            return(array_flip($m[0]));
        }
        return(array());
    }

    public static function _autolink_create_html_tags(&$value, $key, $other=null)
    {
        $target = $nofollow = null;
        if(is_array($other)) {
            $target = ($other['target'] ? " target=\"$other[target]\"":null);
            $nofollow = ($other['nofollow'] ? ' rel="nofollow"':null);
        }
        $value = "<a href=\"$key\" ".($target ? $target : '').' '.($nofollow ? $nofollow : '').">$key</a>";
    }

}
?>
