<?php
header("Access-Control-Allow-Origin: *");
include('simple_html_dom.php');
$allowStock = strtolower(file_get_contents("allowStock")); 
// get DOM from URL or file

$minVol = $_GET['url'] ? $_GET['url'] : 1000000; 
$url = $_GET['url'] ? $_GET['url'] : "https://www.stockmonitor.com/stock-screener/price-above-ma7/?order=volume-desc&page=spage";
$maxpage = $_GET['maxpage'] ? $_GET['maxpage'] : 30; 
 
for ($i=1; $i<$maxpage +1; $i++){

$_url = str_replace('spage', $i, $url);
$html = file_get_html($_url);
$minVol = 1000000;

foreach($html->find('tr') as $e) { 
	//echo $e->innertext;
	$sym = $e->find('td', 0)->plaintext;
	$price = (float)$e->find('td', 1)->plaintext;
	$change = explode(" ",trim(str_replace('+','',$e->find('td', 2)->plaintext)))[0];
	$high = $e->find('td', 3)->plaintext;
	$low = $e->find('td', 4)->plaintext;
	$volume = intval(str_replace(',','',$e->find('td', 5)->plaintext));

	if (!(strpos($allowStock, strtolower($sym)) > -1)) continue;
	if ($volume < $minVol) continue;

	$content[] = array(
		"symbol" => $sym, 
		"price" => $price, 
		"change" => $change,
		"high" => $high,
		"low" => $low,
		"volume" => $volume
	);
}
}

echo json_encode($content, JSON_PRETTY_PRINT);


?>
