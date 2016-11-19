<?php

use micro\utils\StrUtils;
/**
 * Class AjaxUnitTest
 */
abstract class AjaxUnitTest extends UnitTestCase {
    //use \WebDriverAssertions;
    //use \WebDriverDevelop;

    protected static $url = 'http://127.0.0.1:8090/';
    /**
    * @var \RemoteWebDriver
    */
    protected static $webDriver;


    /* (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::setUpBeforeClass()
     */
    public static function setUpBeforeClass() {
        $capabilities = array(\WebDriverCapabilityType::BROWSER_NAME => 'firefox',\WebDriverCapabilityType::VERSION=>'49.0');
        self::$webDriver = \RemoteWebDriver::create('http://localhost:4444/wd/hub', $capabilities);
    }

    public function setUp() {
        parent::setup();
    }

    /* (non-PHPdoc)
     * @see PHPUnit_Framework_TestCase::tearDownAfterClass()
     */
    public static function tearDownAfterClass() {
        if(self::$webDriver!=null)
            self::$webDriver->close();
    }


    /**
     * Loads the relative url $url in web browser
     * @param string $url
     */
    public static function get($url=""){
		self::forceCoverage($url);
        $url=self::$url.$url;
        self::$webDriver->get($url);
    }

    private static function forceCoverage($url){
    	/*if(StrUtils::endswith($url, "/"))
    		$url=substr($url, 0,strlen($url)-1);
    	$urlParts=explode("/", $url);
    	$urlSize=sizeof($urlParts);
    	if($urlSize>0){
    		if($urlSize==1){
    			$urlParts[]="index";
    		}
    		try{
    			$obj=new $urlParts[0]();
    			if(method_exists($obj, $urlParts[1])){
    				\call_user_func(array($obj,$urlParts[1]) );
    			}
    		}catch(Exception $e){

    		}
    	}*/
    }

    /**
     * Returns a given element by id
     * @param string $id HTML id attribute of the element to return
     * @return RemoteWebElement
     */
    public function getElementById($id){
        return self::$webDriver->findElement(\WebDriverBy::id($id));
    }

    /**
     * click on the element by id and force coverage for the url given by the coverageUrlAttribute attribute
     * @param string $id
     * @param string $coverageUrlAttribute
     */
    public function click($id,$coverageUrlAttribute="href"){
    	$elm=$this->getElementById($id);
    	if(isset($elm)){
    		$attr=$elm->getAttribute($coverageUrlAttribute);
    		if(StrUtils::isNotNull($attr))
    			self::forceCoverage($attr);
    		$elm->click();
    	}
    }

    /**
     * <span class="search_hit">Tests</span> if an element exist
     * @param string $css_selector
     * @return boolean
     */
    public function elementExists($css_selector){
        return sizeof($this->getElementsBySelector($css_selector))!==0;
    }

    /**
     * Returns a given element by css selector
     * @param string $css_selector
     * @return RemoteWebElement
     */
    public function getElementBySelector($css_selector){
        return self::$webDriver->findElement(\WebDriverBy::cssSelector($css_selector));
    }

    /**
     * Returns the given elements by css selector
     * @param string $css_selector
     * @return RemoteWebElement
     */
    public function getElementsBySelector($css_selector){
        return self::$webDriver->findElements(\WebDriverBy::cssSelector($css_selector));
    }

    /**
     * Return true if the actual page contains $text
     * @param string $text The text to search for
     */
    public function assertPageContainsText($text){
        $this->assertContains($text, self::$webDriver->getPageSource());
    }
}