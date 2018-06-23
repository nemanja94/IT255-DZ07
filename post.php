<?php
//Kupljenje parametara

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$tip = $_GET['type'];
	$param1 = $_POST['param1'];
	$param2 = $_POST['param2'];
}

if ($tip == "json") {

	header("Content-type: application/json");

	$rez = array (
		'povrsina' => izracunajPovrsinu($param1, $param2),
		'obim' => izracunajObim($param1, $param2)
	);

	echo json_encode($rez);

} else {

	header("Content-type: text/xml");

	$rez = array (
		izracunajPovrsinu($param1, $param2) => 'povrsina',
		izracunajObim($param1, $param2) => 'obim'
	);

	$xml = new SimpleXMLElement('<root/>');
	array_walk_recursive($rez, array ($xml, 'addChild'));
	print $xml->asXML();

}

function izracunajPovrsinu($a, $b) {
	return $hipotenuza = $a * $b;
}

function izracunajObim($a, $b) {
	return $obim = (2 * $a) + (2 * $b);
}

?>
