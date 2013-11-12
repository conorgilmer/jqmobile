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
