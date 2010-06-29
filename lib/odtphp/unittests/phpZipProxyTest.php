<?php
require_once '../library/zip/PhpZipProxy.php';
require_once 'PHPUnit/Framework/TestCase.php';
class PhpZipProxyTest extends PHPUnit_Framework_TestCase
{
    private $odf;
    private $filesNeeded = array('76cdb2bad9582d23c1f6f4d868218d6c' => 'fake.zip' , 'd35214db5b8bf0be4d717b8b5883a2fc' => 'modele_template.odt' , '64e7caa4a131cf1e6411cb3b3ba2b8d4' => 'php_elephant.gif');
    const TEST_PATH = 'testfiles';
    public function __construct()
    {
        parent::__construct();
        if (! is_dir(self::TEST_PATH)) {
            exit('directory ' . self::TEST_PATH . ' not found');
        }
        foreach ($this->filesNeeded as $md5 => $variable) {
            if (! file_exists(self::TEST_PATH . '/' . $variable)) {
                exit("file $variable needed but not found");
            }
            if ($md5 != md5(file_get_contents(self::TEST_PATH . '/' . $variable))) {
                exit("file $variable corrupted");
            }
        }
    }
    protected function setUp()
    {
        $tmp = tempnam(null, md5(uniqid()));
        copy(self::TEST_PATH . '/modele_template.odt', $tmp);
        $this->zip = $zip = new PhpZipProxy();
		$this->zip->open($tmp);
    }
    protected function tearDown()
    {// not needed yet
	}
	public function testGetFromNameWithClosedArchive()
	{
		$this->zip->close();
		$this->assertEquals(false, @$this->zip->getFromName('content.xml'));
	}
	public function testAddFromStringWithClosedArchive()
	{
		$this->zip->close();
		$this->assertEquals(false, @$this->zip->addFromString('content.xml', 'test string'));
	}
	public function testAddFileWithClosedArchive()
	{
		$this->zip->close();
		$this->assertEquals(false, @$this->zip->addFile(self::TEST_PATH . '/php_elephant.gif', 'Pictures/anaska.gif'));
	}
	public function testCloseWithClosedArchive()
	{
		$this->zip->close();
		$this->assertEquals(false, @$this->zip->close());
	}
	public function testOpenWithInexistantArchive()
	{
		$this->zip->close();
		$this->assertEquals(true, $this->zip->open('IdontExist'));
	}
	public function testGetFromNameWithInexistantName()
	{
		$this->assertEquals(false, $this->zip->getFromName('IdontExist'));
	}
	public function testGetFromNameWithExistantName()
	{
		$this->assertType('string', $this->zip->getFromName('content.xml'));
	}
	public function testAddFromStringWithInexistantFile()
	{
		$this->assertEquals(true, $this->zip->addFromString('IdontExist', 'phpunittest'));
	}
	public function testAddFromStringWithExistantFile()
	{
		$this->assertEquals(true, $this->zip->addFromString('content.xml', 'phpunittest'));
	}
	public function testAddFileWithInexistantSourceFile()
	{
		$this->assertEquals(false, $this->zip->addFile('IdontExist', 'Pictures/php_elephant.gif'));
	}
	public function testAddFileWithInexistantDestFile()
	{
		$this->assertEquals(true, $this->zip->addFile(self::TEST_PATH . '/php_elephant.gif', 'Pictures/IdontExist.gif'));
	}
	public function testAddFileWithExistantDestFile()
	{
		$this->assertEquals(true, $this->zip->addFile(self::TEST_PATH . '/php_elephant.gif', 'content.xml'));
	}
	public function testCloseWithOpennedArchive()
	{
		$this->assertEquals(true, $this->zip->close());
	}
}
