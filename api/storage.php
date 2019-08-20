<?php

include('simple_html_dom.php');
if (isset($_GET['url'])){
	$url = $_GET['url'];
} else {
	$url = "https://finviz.com/screener.ashx?v=211&f=cap_midover,sh_avgvol_o1000,ta_sma200_pa&ft=3&o=perf1w";
}

$html = file_get_html($url);
$str = $html->save();
echo $str;

?>
