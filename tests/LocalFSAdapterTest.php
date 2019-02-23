<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use \Blabot\LocalFSAdapter;

class LocalFSAdapterTest extends TestCase
{

    /**
     * @var LocalFSAdapter $adapter
     */
    private $adapter;

    protected function setUp()
    {
        parent::setUp();
        $indexFile = __DIR__ . "/../index.json";
        $dataDir = __DIR__ . "/../data";
        $this->adapter = new LocalFSAdapter($indexFile, $dataDir);
    }

    public function testThrowsOnInvalidIndex(): void
    {
        $indexFile = __DIR__ . "/../invalid-index";
        $dataDir = __DIR__ . "/../data";
        $adapter = new LocalFSAdapter($indexFile, $dataDir);
        $this->expectException(\Blabot\FilesystemException::class);
        $adapter->loadIndex();
    }

    public function testReadsIndex(): void
    {
        $index = $this->adapter->loadIndex();
        $this->assertIsString($index);
        $this->assertNotEmpty($index);
    }

    public function testThrowsOnInvalidDictionaryId(): void
    {
        $this->expectException(\Blabot\FilesystemException::class);
        $this->adapter->loadDictionary('invalid-id');
    }

    public function testReadsDictionary(): void
    {
        $index = $this->adapter->loadDictionary('cs.json');
        $this->assertIsString($index);
        $this->assertNotEmpty($index);
    }
}
