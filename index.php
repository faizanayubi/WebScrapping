<?php 
	require_once('class.scrape.php');
	$amazon = new Scrape('http://www.amazon.in/gp/product/B00OZN0FI0/');  // Instantiating new instance o Scrape class
	
	echo $amazon->title = $amazon->xPathObj->query('//h1')->item(0)->nodeValue;  // Assigning title

	echo "<br>";

	echo $amazon->price = $amazon->xPathObj->query('//span[@id="priceblock_saleprice"]')->item(0)->nodeValue;  // Assigning title
?>