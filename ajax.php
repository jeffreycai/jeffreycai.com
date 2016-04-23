<?php
session_start();
include_once('wp-content/themes/jTwitter/functions.php');

$action = $_GET['action'];

switch ($action)
{
    case 'stopTip':
        unset_flag('tip');
        break;
    case 'startTip':
        set_flag('tip');
        break;
    case 'turnOffSwitch':
        unset_flag('switch');
        break;
    case 'turnOnSwitch':
        set_flag('switch');
        break;
}

?>
