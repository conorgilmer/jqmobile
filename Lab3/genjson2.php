<?php
/*
* Generate JSON
* for coffee shop (corona) example
* write to stream and/or file
*
* By Conor Gilmer
*/


/* require the user as the parameter */
if(isset($_GET['user']) && intval($_GET['user'])) {
	/* soak in the passed variable or set our own */
	$number_of_posts = isset($_GET['num']) ? intval($_GET['num']) : 10; //10 is the default
	$format = strtolower($_GET['format']) == 'json' ? 'json' : 'xml'; //xml is the default
	$user_id = intval($_GET['user']); //no default


//data structure for json arrays
$posts = array("data" => array(
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

	/* output in necessary format */
	if($format == 'json') {
		header('Content-type: application/json');
		echo json_encode(array('posts'=>$posts));
	}
	else {
		header('Content-type: text/xml');
		echo '<posts>';
		foreach($posts as $index => $post) {
			if(is_array($post)) {
				foreach($post as $key => $value) {
					echo '<',$key,'>';
					if(is_array($value)) {
						foreach($value as $tag => $val) {
							echo '<',$tag,'>',htmlentities($val),'</',$tag,'>';
						}
					}
					echo '</',$key,'>';
				}
			}
		}
		echo '</posts>';
	}

}
?>
