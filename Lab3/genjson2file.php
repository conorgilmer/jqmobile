<?php
/*
* Generate JSON to a file
* for coffee shop (corona) example
* write to stream and/or file
*
* By Conor Gilmer
*/

function writeToFile ( $contents, $filename ) {
	$myFile = $filename;
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $contents);
	fclose($fh);
}

//data structure for json arrays
$data = array("data" => array(
  "products" => array(
	"coffees" => array (
			array ( "type" => "Latte",
				"country" => "Italy",
				"desc" => "Hot milk and coffee",
				"image" => "images/coffee1.jpg",
				"price" => "3.50"
				),  

			array ( "type" => "Americano",
				"country" => "USA",
				"desc" => "American style black coffee",
				"image" => "images/coffee2.jpg",
				"price" => "2.20"
				),  

			array ( "type" => "Espresso",
				"country" => "Italy",
				"desc" => "Finest Italian Espresso coffee",
				"image" => "images/coffee3.jpg",
				"price" => "2.90"
				)  
			)
		,
	"teas" => array (
			array ( "type" => "Breakfast",
				"country" => "Ireland",
				"desc" => "Refreshing Tea",
				"image" => "images/tea1.jpg",
				"price" => "1.50"
				),  

			array ( "type" => "Peppermint",
				"country" => "USA",
				"desc" => "Mint tea",
				"image" => "images/tea2.jpg",
				"price" => "2.00"
				),  

			array ( "type" => "Lemon",
				"country" => "france",
				"desc" => "Warm Lemon Tea",
				"image" => "images/tea3.jpg",
				"price" => "2.10"
				)  
			)
		)
	)
	);

//output to file
$output =  json_encode($data);
writeToFile($output, "output.json");

// Output to console
//header('Cache-Control: no-cache, must-revalidate');
//header('Expires: Mon, 26 Jul 2014 05:00:00 GMT');
header('Content-type: application/json');
echo $output;

?>
