<?php
/*
* Generate JSON
* for coffee shop (corona) example
* write to stream using callback function
* e.g http://localhost/genjson.php?callback=listposts 
*
* TODO- Array could be populated from Database
*
* By Conor Gilmer
*/


$data = array("data" => array(
  "products" => array(
	"coffees" => array (
			array ( "type" => "Latte",
				"country" => "Italy",
				"wiki" => "https://en.wikipedia.org/wiki/Latte",
				"desc" => "Hot milk and coffee",
				"image" => "images/coffee1.png",
				"price" => "3.50"
				),  

			array ( "type" => "Americano",
				"country" => "USA",
				"wiki" => "https://en.wikipedia.org/wiki/Caff%C3%A8_Americano",
				"desc" => "American style black coffee",
				"image" => "images/coffee2.png",
				"price" => "2.20"
				),  

			array ( "type" => "Espresso",
				"country" => "Italy",
				"wiki" => "https://en.wikipedia.org/wiki/Espresso",
				"desc" => "Finest Italian Espresso coffee",
				"image" => "images/coffee3.png",
				"price" => "2.90"
				)  
			)
		,
	"teas" => array (
			array ( "type" => "Breakfast",
				"country" => "Ireland",
				"wiki" => "g/wiki/tea",
				"desc" => "Refreshing Tea",
				"image" => "images/tea3.png",
				"price" => "1.50"
				),  

			array ( "type" => "Peppermint",
				"country" => "Morocco",
				"wiki" => "https://en.wikipedia.org/wiki/Touareg_tea",
				"desc" => "Mint tea",
				"image" => "images/tea1.png",
				"price" => "2.00"
				),  

			array ( "type" => "Lemon",
				"country" => "france",
				"wiki" => "https://en.wikipedia.org/wiki/tea",
				"desc" => "Warm Lemon Tea2",
				"image" => "images/tea2.png",
				"price" => "2.10"
				)  
			)
		)
	)
	);

//encode data to json
$output =  json_encode($data);

//format for callback function
if(array_key_exists('callback', $_GET)){

    header('Content-Type: text/javascript; charset=utf8');
    header('Access-Control-Allow-Origin: http://www.example.com/');
    header('Access-Control-Max-Age: 3628800');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

    $callback = $_GET['callback'];
    echo $callback.'('.$output.');';

}else{

// Output to console
header('Content-type: application/json; charset=utf8');
echo $output;
}
?>
