<?php
header("Access-Control-Allow-Origin: *");
include('simple_html_dom.php');


$url = "https://finviz.com/screener.ashx?v=111&f=cap_smallover,sh_avgvol_o1000";

exec("wget '$url' -O _temp");

echo file_get_contents('_temp');
