<?php
class Scrape {
	// Declaring class variables and arrays 
	public $url;
	public $source;
	//public $baseUrl;
	private $baseUrl;
	private $parsedUrl = array();
	
	// Construct method called on instantiation of object
	function __construct($url) {
		$this->url = $url;
		// Setting URL attribute
		$this->source = $this->curlGet($this->url);
		$this->xPathObj = $this->returnXpathObject($this->source);
		$this->parsedUrl = parse_url($this->url);
		$this->baseUrl = $this->parsedUrl['scheme'] .'://' . $this->parsedUrl['host'];
	}

	// Method for making a GET request using cURL  

	public function curlGet($url) {
		$ch = curl_init(); // Initialising cURL session    
		// Setting cURL options
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  // Returning transfer as a string    
    	curl_setopt($ch, CURLOPT_URL, $url);  // Setting URL    
    	$results = curl_exec($ch);  // Executing cURL session    
    	curl_close($ch);  // Closing cURL session    
    	return $results;  // Return the results  
    }

    // Method to return XPath object
    public function returnXPathObject($item) {
    	$xmlPageDom = new DomDocument();  // Instantiating a new DomDocument object
    	@$xmlPageDom->loadHTML($item);  // Loading the HTML from downloaded page    
    	$xmlPageXPath = new DOMXPath($xmlPageDom);  // Instantiating new XPath DOM object    
    	return $xmlPageXPath;  // Returning XPath object
    }

    // Method to submit form using cURL POST method 
    public function curlPost($postUrl, $postFields, $successString) {
    	$useragent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3';
    	// Setting user agent of a popular browser    
    	$cookie = 'cookie.txt';  // Setting a cookie file to store cookie    
    	$ch = curl_init();  // Initialising cURL session
    	// Setting cURL options  
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // Prevent cURL from verifying SSL certificate  
    	curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);  // Script should fail silently on error  
    	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);  // Use cookies  
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);  // Follow Location: headers  
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  // Returning transfer as a string  
    	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  // Setting cookiefile  
    	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);  // Setting cookiejar  
    	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);  // Setting useragent  c
    	url_setopt($ch, CURLOPT_URL, $postUrl);  // Setting URL to POST to        
    	curl_setopt($ch, CURLOPT_POST, TRUE);  // Setting method as POST  
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));  // Setting POST fields as array       
    	$results = curl_exec($ch);  // Executing cURL session  
    	curl_close($ch);  // Closing cURL session    
    	// Checking if login was successful by checking existence of string  
    	if (strpos($results, $successString)) {
    		return $results;
    	} else {
    		return FALSE;
    	}
    }
}

?> 