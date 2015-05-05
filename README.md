# WebScrapping
A PHP Script for scrapping website with Object Oriented Way, The main Technology used is CURL. the example below shows step by step instructions to scrape Amazon

![WebScrapping](https://github.com/faizanayubi/WebScrapping/blob/master/Output.PNG?raw=true)

### Example: Scrapping Amazon Products ###
1. include the class
```
require_once('class.scrape.php');
```

2. Create a Instance of Scrape class by providing the url you want to scrape
```
$amazon = new Scrape('http://www.amazon.in/gp/product/B00OZN0FI0/');
```

3. Getting Product Title
```
$amazon->title = $amazon->xPathObj->query('//h1')->item(0)->nodeValue;
```
The methods function and defination is commented in class

4. Getting Product Price
```
$amazon->price = $amazon->xPathObj->query('//span[@id="priceblock_saleprice"]')->item(0)->nodeValue;
```

### Result ###
![WebScrapping](https://github.com/faizanayubi/WebScrapping/blob/master/Output.PNG?raw=true)